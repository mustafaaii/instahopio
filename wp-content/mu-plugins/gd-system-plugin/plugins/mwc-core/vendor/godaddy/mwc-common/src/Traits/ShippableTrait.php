<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use GoDaddy\WordPress\MWC\Common\Models\Address;

/**
 * A trait for objects that are shippable.
 *
 * @since x.y.z
 */
trait ShippableTrait
{
    /** @var Address the shipping address */
    protected $shippingAddress;

    /**
     * Gets the shipping address.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getShippingAddress() : Address
    {
        return $this->shippingAddress;
    }

    /**
     * Sets the shipping address.
     *
     * @since x.y.z
     *
     * @param Address $address
     * @return self
     */
    public function setShippingAddress(Address $address)
    {
        $this->shippingAddress = $address;

        return $this;
    }
}
