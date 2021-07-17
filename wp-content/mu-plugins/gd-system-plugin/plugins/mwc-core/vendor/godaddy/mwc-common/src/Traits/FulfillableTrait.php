<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use GoDaddy\WordPress\MWC\Common\Contracts\FulfillmentStatusContract;

/**
 * A trait for objects that handle fulfillment.
 *
 * @since x.y.z
 */
trait FulfillableTrait
{
    /** @var FulfillmentStatusContract fulfillment status */
    protected $fulfillmentStatus;

    /** @var bool whether the represented entity needs shipping or not */
    protected $needsShipping;

    /**
     * Gets the fulfillment status.
     *
     * @since x.y.z
     *
     * @return FulfillmentStatusContract|null
     */
    public function getFulfillmentStatus()
    {
        return $this->fulfillmentStatus;
    }

    /**
     * Sets the fulfillment status
     *
     * @since x.y.z
     *
     * @param FulfillmentStatusContract $fulfillmentStatus
     * @return self
     */
    public function setFulfillmentStatus(FulfillmentStatusContract $fulfillmentStatus)
    {
        $this->fulfillmentStatus = $fulfillmentStatus;

        return $this;
    }

    /**
     * Determines whether the represented entity needs shipping or not.
     *
     * @since x.y.z
     *
     * @return bool
     */
    public function getNeedsShipping() : bool
    {
        return $this->needsShipping ?? false;
    }

    /**
     * Sets the "needs shipping" property.
     *
     * @since x.y.z
     *
     * @param bool $needsShipping
     * @return self
     */
    public function setNeedsShipping(bool $needsShipping)
    {
        $this->needsShipping = $needsShipping;

        return $this;
    }
}
