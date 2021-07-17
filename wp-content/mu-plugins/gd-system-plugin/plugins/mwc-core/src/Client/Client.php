<?php

namespace GoDaddy\WordPress\MWC\Core\Client;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Enqueue\Enqueue;
use GoDaddy\WordPress\MWC\Common\Helpers\StringHelper;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\ManagedWooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPressRepository;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\GoDaddyPayments\Frontend\Admin\Notices;

/**
 * MWC Client class.
 *
 * @since x.y.z
 */
class Client
{
    /** @var string the app source, normally a URL */
    protected $appSource;

    /** @var string the identifier of the application */
    protected $appHandle;

    /**
     * MWC Client constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (! ManagedWooCommerceRepository::hasEcommercePlan()) {
            return;
        }

        $this->appHandle = 'mwcClient';
        $this->appSource = Configuration::get('mwc.client.index.url');

        $this->registerHooks();
    }

    /**
     * Registers the client's hook handlers.
     *
     * @since x.y.z
     *
     * @return Client
     * @throws Exception
     */
    protected function registerHooks() : Client
    {
        Register::action()
            ->setGroup('admin_body_class')
            ->setHandler([$this, 'addAdminBodyClasses'])
            ->execute();

        Register::action()
            ->setGroup('admin_enqueue_scripts')
            ->setHandler([$this, 'enqueueAssets'])
            ->execute();

        Register::action()
            ->setGroup('admin_print_styles')
            ->setHandler([$this, 'enqueueMessagesContainerStyles'])
            ->execute();

        Register::action()
            ->setGroup('all_admin_notices')
            ->setHandler([$this, 'renderMessagesContainer'])
            ->execute();

        Register::action()
            ->setGroup('admin_footer')
            ->setHandler([$this, 'renderPlatformAppContainer'])
            ->execute();

        return $this;
    }

    /**
     * Adds utility classes to the body element in the admin dashboard.
     *
     * @internal
     *
     * @since 2.1.4
     *
     * @param string $classes space separated list of classes for the body element in the admin dashboard
     */
    public function addAdminBodyClasses($classes)
    {
        if (! $version = $this->getWooCommerceVersion()) {
            return;
        }

        if (version_compare($version, '5.2.0', '>=')) {
            $classes .= ' mwc-wc-version-gte-5-2';
        }

        return $classes;
    }

    /**
     * Gets the currently active version of WooCommerce or null if the plugin is not active.
     *
     * We can't use woocommerce.version configuration value because that's currently always set to null.
     *
     * @since 2.1.4
     *
     * @return string|null
     */
    protected function getWooCommerceVersion() : string
    {
        return defined('WC_VERSION') ? constant('WC_VERSION') : null;
    }

    /**
     * Render the styles for the container div.
     *
     * @since x.y.z
     *
     * @return void
     * @throws Exception
     */
    public function enqueueMessagesContainerStyles()
    {
        Enqueue::style()
            ->setHandle("{$this->appHandle}-messages-styles")
            ->setSource(StringHelper::trailingSlash(Configuration::get('mwc.assets.styles')).'mwc-messages-container.css')
            ->execute();
    }

    /**
     * Render the styles for the container div.
     *
     * @since x.y.z
     *
     * @return void
     * @throws Exception
     */
    public function renderMessagesContainer()
    {
        ?>
        <div id="mwc-messages-container" class="mwc-messages-container"></div>
        <?php
    }

    /**
     * Renders the container div for the platform app.
     *
     * @since x.y.z
     *
     * @return void
     * @throws Exception
     */
    public function renderPlatformAppContainer()
    {
        ?>
        <div id="mwc-platform-app"></div>
        <?php
    }

    /**
     * Enqueues/loads registered assets.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    public function enqueueAssets()
    {
        Enqueue::script()
               ->setHandle("{$this->appHandle}-runtime")
               ->setSource(Configuration::get('mwc.client.runtime.url'))
               ->setDeferred(true)
               ->execute();

        Enqueue::script()
               ->setHandle("{$this->appHandle}-vendors")
               ->setSource(Configuration::get('mwc.client.vendors.url'))
               ->setDeferred(true)
               ->execute();

        $this->enqueueApp();
        $this->enqueueNoticesAssets();
    }

    /**
     * Enqueues the single page application script.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    protected function enqueueApp()
    {
        $script = Enqueue::script()
                         ->setHandle($this->appHandle)
                         ->setSource($this->appSource)
                         ->setDeferred(true);

        $inlineScriptVariables = $this->getInlineScriptVariables();

        if (! empty($inlineScriptVariables)) {
            $script->attachInlineScriptObject($this->appHandle)
                   ->attachInlineScriptVariables($inlineScriptVariables);
        }

        $script->execute();
    }

    /**
     * Gets inline script variables.
     *
     * @since x.y.z
     *
     * @return array
     */
    protected function getInlineScriptVariables() : array
    {
        return array_merge([
            'root'  => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest'),
        ], $this->getPageContextVariables());
    }

    /**
     * Gets inline script variables that describe the current page.
     *
     * @since x.y.z
     *
     * @return array
     */
    protected function getPageContextVariables() : array
    {
        $currentScreen = WordPressRepository::getCurrentScreen();

        return $currentScreen ? $currentScreen->toArray() : [];
    }

    /**
     * Enqueues the notices script.
     */
    protected function enqueueNoticesAssets()
    {
        Enqueue::script()
            ->setHandle("{$this->appHandle}-notices")
            ->setSource(WordPressRepository::getAssetsUrl('js/notices.js'))
            ->setDeferred(true)
            ->attachInlineScriptObject('MWCNotices')
            ->attachInlineScriptVariables([
                'dismissNoticeAction' => Notices::ACTION_DISMISS_NOTICE,
            ])
            ->execute();
    }
}
