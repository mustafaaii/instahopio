<?php

namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;

/**
 * An representation of fee item in an Order.
 *
 * @since x.y.z
 */
class FeeItem extends AbstractOrderItem
{
    /** @var CurrencyAmount total tax amount */
    protected $taxAmount;

    /**
     * Gets the tax total amount object.
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
     * Sets tax total amount object.
     *
     * @since x.y.z
     *
     * @param CurrencyAmount $taxAmount
     *
     * @return FeeItem
     */
    public function setTaxAmount(CurrencyAmount $taxAmount) : FeeItem
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }
}
