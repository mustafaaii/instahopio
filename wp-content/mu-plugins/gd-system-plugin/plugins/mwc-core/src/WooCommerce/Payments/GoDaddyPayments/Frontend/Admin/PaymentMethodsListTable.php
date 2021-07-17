<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\GoDaddyPayments\Frontend\Admin;

use Exception;
use GoDaddy\WordPress\MWC\Common\Enqueue\Enqueue;
use GoDaddy\WordPress\MWC\Common\Enqueue\Types\EnqueueScript;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPressRepository;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt\Onboarding;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Events\Producers\OnboardingEventsProducer;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\GoDaddyPaymentsGateway;
use WC_Payment_Gateway;

/**
 * The payment methods list table handler.
 */
class PaymentMethodsListTable
{
    /** @var string name for the action column */
    protected static $actionColumnName = 'onboarding-action';

    /** @var string name for the status column */
    protected static $statusColumnName = 'onboarding-status';

    /**
     * ListTable constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        Register::action()
            ->setGroup('admin_enqueue_scripts')
            ->setCondition([$this, 'shouldEnqueueScripts'])
            ->setHandler([$this, 'enqueueScripts'])
            ->execute();

        Register::action()
            ->setGroup('admin_menu')
            ->setHandler([$this, 'addHubMenuItem'])
            ->execute();

        Register::action()
            ->setGroup('admin_footer')
            ->setHandler([$this, 'renderOnboardingModal'])
            ->execute();

        Register::filter()
            ->setGroup('woocommerce_payment_gateways_setting_columns')
            ->setArgumentsCount(1)
            ->setHandler([$this, 'addColumns'])
            ->execute();

        Register::action()
            ->setGroup('woocommerce_payment_gateways_setting_column_'.static::$actionColumnName)
            ->setArgumentsCount(1)
            ->setHandler([$this, 'renderActionCell'])
            ->execute();

        Register::action()
            ->setGroup('woocommerce_payment_gateways_setting_column_'.static::$statusColumnName)
            ->setArgumentsCount(1)
            ->setHandler([$this, 'renderStatusCell'])
            ->execute();
    }

    /**
     * Adds the Status and Action columns to the table.
     *
     * @param mixed $columns
     *
     * @return mixed
     */
    public function addColumns($columns)
    {
        if (! ArrayHelper::accessible($columns)) {
            return $columns;
        }

        $newColumns = [];

        foreach ($columns as $name => $label) {
            if ('action' === $name) {
                $newColumns[static::$statusColumnName] = __('Status', 'mwc-core');
                $newColumns[static::$actionColumnName] = '';
                continue;
            }

            $newColumns[$name] = $label;
        }

        return $newColumns;
    }

    /**
     * Adds a menu item to the WordPress menu linking to the Hub.
     *
     * @internal
     *
     * @throws Exception
     */
    public function addHubMenuItem()
    {
        global $submenu;

        if (! Onboarding::canEnablePaymentGateway(Onboarding::getStatus())) {
            return;
        }

        $submenu['woocommerce'][] = [
            __('GoDaddy Payments', 'mwc-core').'<span class="dashicons dashicons-external" style="width:12px;height:12px;font-size:18px;"></span>', // tweak the icon to smaller to fit the container
            'manage_woocommerce',
            add_query_arg('businessId', Poynt::getBusinessId(), Poynt::getHubUrl()),
        ];
    }

    /**
     * Enqueues the scripts.
     *
     * @internal
     *
     * @throws Exception
     */
    public function enqueueScripts()
    {
        $onboardingStatus = Onboarding::getStatus();

        Enqueue::style()
            ->setHandle('mwc-payments-payment-methods')
            ->setSource(WordPressRepository::getAssetsUrl('css/payments/payment-methods.css'))
            ->execute();

        EnqueueScript::script()
            ->setHandle('mwc-payments-payment-methods')
            ->setSource(WordPressRepository::getAssetsUrl('js/payments/payment-methods.js'))
            ->setDependencies([
                'backbone',
                'wc-backbone-modal',
                'jquery',
            ])
            ->attachInlineScriptObject('MWCPaymentsPaymentMethods')
            ->attachInlineScriptVariables([
                'gatewayId' => 'poynt',
                'status'    => $onboardingStatus,
                'allowButton' => ! ArrayHelper::contains([Onboarding::STATUS_SUSPENDED, Onboarding::STATUS_PENDING], $onboardingStatus),
                'allowEnable' => Onboarding::canEnablePaymentGateway(Onboarding::getStatus()),
                'allowManage' => Onboarding::canManagePaymentGateway(Onboarding::getStatus()),
                'setupIntentAction' => OnboardingEventsProducer::ACTION_SETUP_INTENT,
                'setupIntentNonce'  => wp_create_nonce(OnboardingEventsProducer::ACTION_SETUP_INTENT),
                'removePaymentMethodAction' => OnboardingEventsProducer::ACTION_REMOVE_PAYMENT_METHOD,
                'removePaymentMethodNonce' => wp_create_nonce(OnboardingEventsProducer::ACTION_REMOVE_PAYMENT_METHOD),
            ])
            ->execute();
    }

    /**
     * Gets the button label.
     *
     * @param string $status
     *
     * @return string
     * @throws Exception
     */
    protected function getButtonLabel(string $status) : string
    {
        switch ($status) {

            case '':
            case Onboarding::STATUS_DISCONNECTED:
                $label = __('Set up', 'mwc-core');
                break;

            case Onboarding::STATUS_INCOMPLETE:
                $label = __('Resume', 'mwc-core');
                break;

            case Onboarding::STATUS_DECLINED:
            case Onboarding::STATUS_TERMINATED:
                $label = __('Remove', 'mwc-core');
                break;

            default:
                $label = __('Manage', 'mwc-core');
        }

        return $label;
    }

    /**
     * Gets the HTML for displaying the given status.
     *
     * @param string $status
     *
     * @return string
     */
    public static function getStatusHtml(string $status) : string
    {
        switch ($status) {
            case '':
                $label = __('Recommended', 'mwc-core');
                $tooltip = __('2.9% + 30¢ per transaction on all major credit cards.', 'mwc-core');
                break;
            case Onboarding::STATUS_CONNECTED:
                $label = __('Connected', 'mwc-core');
                $tooltip = __('Connected to your GoDaddy Payments account.', 'mwc-core');
                break;
            case Onboarding::STATUS_DECLINED:
                $label = __('Not available', 'mwc-core');
                $tooltip = __('Thank you for applying, but we are unable to provide payment processing for your business.', 'mwc-core');
                break;
            case Onboarding::STATUS_DISCONNECTED:
                $label = __('Disconnected', 'mwc-core');
                $tooltip = __('Your account has been closed.', 'mwc-core');
                break;
            case Onboarding::STATUS_INCOMPLETE:
                $label = __('Incomplete', 'mwc-core');
                $tooltip = __('Click Resume to complete your application.', 'mwc-core');
                break;
            case Onboarding::STATUS_NEEDS_ATTENTION:
            case Onboarding::STATUS_SUSPENDED:
                $label = __('Needs attention', 'mwc-core');
                $tooltip = __('Please check your email for next steps.', 'mwc-core');
                break;
            case Onboarding::STATUS_PENDING:
                $label = __('Pending', 'mwc-core');
                $tooltip = __('Please check your email for next steps.', 'mwc-core');
                break;
            case Onboarding::STATUS_TERMINATED:
                $label = __('Not available', 'mwc-core');
                $tooltip = __('Your GoDaddy Payments account has been terminated.', 'mwc-core');
                break;
            default:
                return '';
        }

        return '<mark class="mwc-payments-godaddy-onboarding-status tips '.esc_attr(strtolower($status)).'" data-tip="'.esc_attr($tooltip).'">'.esc_html($label).'</mark>';
    }

    /**
     * Renders the action column's cell.
     *
     * @internal
     *
     * @param mixed $gateway
     *
     * @throws Exception
     */
    public function renderActionCell($gateway)
    {
        if (! $gateway instanceof WC_Payment_Gateway) {
            return;
        }

        $title = $gateway->get_method_title() ? $gateway->get_method_title() : $gateway->get_title();
        $url = admin_url('admin.php?page=wc-settings&tab=checkout&section='.strtolower($gateway->id));

        $classes = [
            'button',
            'alignright',
        ];

        if ($gateway instanceof GoDaddyPaymentsGateway) {
            $status = Onboarding::getStatus();

            $classes[] = $status ? strtolower($status) : 'start';

            $label = $this->getButtonLabel($status);

            if (! $status || Onboarding::STATUS_INCOMPLETE === $status) {
                $url = $this->getOnboardingStartUrl();
            } elseif (ArrayHelper::contains([Onboarding::STATUS_DECLINED, Onboarding::STATUS_TERMINATED], $status)) {
                $classes[] = 'remove';
            }
        } elseif (wc_string_to_bool($gateway->enabled)) {
            $ariaLabel = sprintf(__('Manage the "%s" payment method', 'woocommerce'), $title);
            $label = __('Manage', 'woocommerce');
        } else {
            $ariaLabel = sprintf(__('Set up the "%s" payment method', 'woocommerce'), $title);
            $label = __('Set up', 'woocommerce');
        } ?>

        <td class="<?php echo esc_attr(static::$actionColumnName); ?>" width="1%">

            <a
                class="<?php echo esc_attr(implode(' ', $classes)); ?>"
                aria-label="<?php echo ! empty($ariaLabel) ? esc_attr($ariaLabel) : ''; ?>"
                href="<?php echo esc_url($url); ?>"
            >
                <?php echo esc_html($label); ?>
            </a>

        </td>

        <?php
    }

    /**
     * Renders the status column cell.
     *
     * @param mixed $gateway
     *
     * @throws Exception
     */
    public function renderStatusCell($gateway)
    {
        ?>

        <td class="<?php echo esc_attr(static::$statusColumnName); ?>" width="1%">

            <?php if ($gateway instanceof GoDaddyPaymentsGateway) : ?>
                <?php echo $this->getStatusHtml(Onboarding::getStatus()); // TODO: label/react app {@cwiseman 2021-05-19}?>
            <?php endif; ?>

        </td>

        <?php
    }

    /**
     * Renders the onboarding modal.
     */
    public function renderOnboardingModal()
    {
        ?>
        <script type="text/template" id="tmpl-mwc-payments-godaddy-onboarding-start">
            <div class="wc-backbone-modal mwc-payments-godaddy-onboarding-start">
                <div class="wc-backbone-modal-content">
                    <section class="wc-backbone-modal-main" role="main">
                        <header class="wc-backbone-modal-header">
                            <h1><?php esc_html_e('Set up GoDaddy Payments', 'mwc-core'); ?></h1>
                            <button class="modal-close modal-close-link dashicons dashicons-no-alt">
                                <span class="screen-reader-text"><?php esc_html_e('Close modal panel', 'woocommerce-customer-order-csv-export'); ?></span>
                            </button>
                        </header>
                        <article>
                            <div class="description">
                                <?php esc_html_e('You\'re about to open GoDaddy Payments account signup. In just a few minutes, you\'ll return here to enable secure payments in your checkout.', 'mwc-core'); ?>
                            </div>
                            <div class="details">
                                <div class="callout">
                                    <?php esc_html_e('Connect to GoDaddy Payments to quickly and easily accept all major credit cards with no setup fees or contracts.', 'mwc-core'); ?>
                                </div>
                                <div class="pricing">
                                    <span class="cost"><?php esc_html_e('2.9% + 30¢', 'mwc-core'); ?></span>
                                    <?php esc_html_e('On all transactions', 'mwc-core'); ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </article>
                        <footer>
                            <div class="inner">
                                <a href="#" id="btn-cancel" class="button button-clean modal-close"><?php esc_html_e('Cancel', 'mwc-core'); ?></a>
                                <a href="<?php echo esc_url($this->getOnboardingStartUrl()); ?>" class="button button-large onboarding-start"><?php esc_html_e('Set up GoDaddy Payments', 'mwc-core'); ?></a>
                            </div>
                        </footer>
                    </section>
                </div>
            </div>
            <div class="wc-backbone-modal-backdrop modal-close"></div>
        </script>
        <?php
    }

    /**
     * Determines if the scripts should be enqueued.
     *
     * @internal
     *
     * @return bool
     */
    public function shouldEnqueueScripts()
    {
        return 'wc-settings' === ArrayHelper::get($_GET, 'page') && 'checkout' === ArrayHelper::get($_GET, 'tab');
    }

    /**
     * Gets the URL to kick off onboarding.
     *
     * @return string
     */
    protected function getOnboardingStartUrl() : string
    {
        return OnboardingEventsProducer::getOnboardingStartUrl();
    }
}
