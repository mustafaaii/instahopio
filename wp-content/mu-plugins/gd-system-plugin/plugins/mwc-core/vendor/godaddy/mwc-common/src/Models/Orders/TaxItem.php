<?php

namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

/**
 * An representation of tax item in an Order.
 *
 * @since x.y.z
 */
class TaxItem extends AbstractOrderItem
{
    /**
     * tax item's rate.
     *
     * @since x.y.z
     *
     * @var float
     */
    protected $rate;

    /**
     * Gets tax item rate.
     *
     * @since x.y.z
     *
     * @return float
     */
    public function getRate() : float
    {
        return $this->rate;
    }

    /**
     * Sets tax item rate.
     *
     * @param float $rate
     *
     * @since x.y.z
     *
     * @return TaxItem
     */
    public function setRate(float $rate) : TaxItem
    {
        $this->rate = $rate;

        return $this;
    }
}
