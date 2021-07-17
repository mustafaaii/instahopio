<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use GoDaddy\WordPress\MWC\Common\Models\Address;

/**
 * A trait for objects that are billable.
 *
 * @since x.y.z
 */
trait BillableTrait
{
    /** @var Address the billing address */
    protected $billingAddress;

    /**
     * Gets the billing address.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getBillingAddress() : Address
    {
        return $this->billingAddress;
    }

    /**
     * Sets the billing address.
     *
     * @since x.y.z
     *
     * @param Address $address
     * @return self
     */
    public function setBillingAddress(Address $address)
    {
        $this->billingAddress = $address;

        return $this;
    }
}
