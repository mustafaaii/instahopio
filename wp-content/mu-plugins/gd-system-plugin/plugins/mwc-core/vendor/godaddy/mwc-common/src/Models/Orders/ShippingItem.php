<?php

namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;

/**
 * An representation of shipping item in an Order.
 *
 * @since x.y.z
 */
class ShippingItem extends AbstractOrderItem
{
    /**
     * shipping item's total tax amount.
     *
     * @since x.y.z
     *
     * @var CurrencyAmount
     */
    protected $taxAmount;

    /**
     * Gets shipping item tax total amount object.
     *
     * @since x.y.z
     *
     * @return CurrencyAmount
     */
    public function getTaxAmount() : CurrencyAmount
    {
        return $this->taxAmount;
    }

    /**
     * Sets shipping item tax total amount object.
     *
     * @param CurrencyAmount $taxAmount
     *
     * @since x.y.z
     *
     * @return ShippingItem
     */
    public function setTaxAmount(CurrencyAmount $taxAmount) : ShippingItem
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }
}
