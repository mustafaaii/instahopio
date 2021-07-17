<?php

namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait;

/**
 * A representation of a line Item in an order.
 *
 * @since x.y.z
 */
class LineItem extends AbstractOrderItem
{
    use FulfillableTrait;

    /** @var int|float the line item's quantity */
    protected $quantity;

    /** @var CurrencyAmount the line item's total tax amount */
    protected $taxAmount;

    /**
     * Gets the line item amount.
     *
     * @since x.y.z
     *
     * @return int|float
     */
    public function getQuantity() : float
    {
        return $this->quantity;
    }

    /**
     * Gets the line item tax total amount.
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
     * Sets the line item quantity.
     *
     * @since x.y.z
     *
     * @param int|float $quantity
     * @return LineItem
     */
    public function setQuantity(float $quantity) : LineItem
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Sets the line item tax total amount.
     *
     * @since x.y.z
     *
     * @param CurrencyAmount $taxAmount
     * @return LineItem
     */
    public function setTaxAmount(CurrencyAmount $taxAmount) : LineItem
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }
}
