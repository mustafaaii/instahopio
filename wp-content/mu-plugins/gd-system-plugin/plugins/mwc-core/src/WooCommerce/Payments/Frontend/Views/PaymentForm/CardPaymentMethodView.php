<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Frontend\Views\PaymentForm;

use GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Frontend\Views\Traits\RendersCardPaymentMethodTrait;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;

/**
 * The card payment method view at checkout.
 *
 * @since x.y.z
 *
 * @method CardPaymentMethod getPaymentMethod()
 */
class CardPaymentMethodView extends PaymentMethodView
{
    use RendersCardPaymentMethodTrait;

    /**
     * Renders the card's title.
     *
     * @since x.y.z
     */
    protected function renderTitle()
    {
        parent::renderTitle();

        echo $this->getLastFourHtml();

        if ($expirationDate = $this->getFormattedExpirationDate()) {
            echo '<span class="expiration">(expires ' . esc_html($expirationDate) . ')</span>';
        }
    }

    /**
     * Gets the formatted expiration date.
     *
     * @since x.y.z
     *
     * @return string
     */
    protected function getFormattedExpirationDate() : string
    {
        $year = $this->getPaymentMethod()->getExpirationYear();

        // display a year at minimum
        if (! $year) {
            return '';
        }

        $month = $this->getPaymentMethod()->getExpirationMonth();

        if ($month) {
            $year = substr($year, -2);

            return "{$month}/{$year}";
        } else {
            return 2 === strlen($year) ? "20{$year}" : $year;
        }
    }
}
