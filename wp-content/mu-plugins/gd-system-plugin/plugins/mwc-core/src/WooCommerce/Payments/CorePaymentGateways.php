<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments;

use Exception;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Frontend\MyPaymentMethods;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\GoDaddyPayments\Frontend\Admin\PaymentMethodsListTable;

/**
 * Core payment gateways.
 *
 * Takes care of the necessary tasks for adding the core gateway(s) in a way that WooCommerce understands.
 *
 * @since x.y.z
 */
class CorePaymentGateways
{
    /** @var string[] classes to load as universal handlers */
    private $handlerClasses = [
        Captures::class,
        PaymentMethodsListTable::class,
        MyPaymentMethods::class,
    ];

    /** @var string[] payments gateways to load */
    protected static $paymentGatewayClasses = [
        GoDaddyPaymentsGateway::class,
    ];

    /** @var AbstractPaymentGateway[] */
    private static $paymentGateways = [];

    /**
     * CorePaymentGateways constructor.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->addHooks();
    }

    /**
     * Loads the payments handlers.
     *
     * @internal
     */
    public function loadHandlers()
    {
        // don't load anything if we don't have any gateways enabled
        if (empty(static::getPaymentGateways())) {
            return;
        }

        foreach ($this->handlerClasses as $class) {
            new $class();
        }
    }

    /**
     * Adds instance of the gateways contained in $paymentGateways to the WooCommerce provided
     * $gateways param.
     *
     * @internal
     *
     * @param mixed $gateways
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function loadPaymentGateways($gateways) : array
    {
        if (! ArrayHelper::accessible($gateways)) {
            return $gateways;
        }

        // add our gateways to the top of the list
        foreach (static::getPaymentGateways() as $gateway) {
            array_unshift($gateways, $gateway);
        }

        return $gateways;
    }

    /**
     * Register the woocommerce_payment_gateways hook with loadPaymentGateways as the callback.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    private function addHooks()
    {
        Register::action()
            ->setGroup('init')
            ->setHandler([$this, 'loadHandlers'])
            ->execute();

        Register::filter()
            ->setGroup('woocommerce_payment_gateways')
            ->setArgumentsCount(1)
            ->setHandler([$this, 'loadPaymentGateways'])
            ->execute();
    }

    /**
     * Gets a list of initialized core payment gateways.
     *
     * @since x.y.z
     *
     * @return AbstractPaymentGateway[]
     */
    public static function getPaymentGateways() : array
    {
        if (! empty(static::$paymentGateways)) {
            return static::$paymentGateways;
        }

        foreach (static::$paymentGatewayClasses as $class) {
            if (! $class::isActive()) {
                continue;
            }

            /** @var AbstractPaymentGateway $gateway */
            $gateway = new $class;

            static::$paymentGateways[$gateway->id] = $gateway;
        }

        return static::$paymentGateways;
    }
}
