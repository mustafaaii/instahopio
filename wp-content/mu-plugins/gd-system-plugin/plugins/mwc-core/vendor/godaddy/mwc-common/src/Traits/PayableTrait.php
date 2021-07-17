<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

/**
 * A trait for objects that handle payments.
 *
 * @since x.y.z
 */
trait PayableTrait
{
    /** @var string payment status */
    protected $paymentStatus;

    /**
     * Gets the payment status.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getPaymentStatus() : string
    {
        return is_string($this->paymentStatus) ? $this->paymentStatus : '';
    }

    /**
     * Sets the payment status.
     *
     * @since x.y.z
     *
     * @param string $status
     * @return self
     */
    public function setPaymentStatus(string $status)
    {
        $this->paymentStatus = $status;

        return $this;
    }
}
