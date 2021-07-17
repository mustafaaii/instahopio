<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Models\Transactions;

use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction as PaymentsPaymentTransaction;

/**
 * Payment transaction.
 *
 * @since x.y.z
 */
class PaymentTransaction extends PaymentsPaymentTransaction
{
    /** @var bool $tokenize */
    private $tokenize = false;

    /**
     * Get the value of tokenize.
     *
     * @since x.y.z
     *
     * @return bool
     */
    public function shouldTokenize() : bool
    {
        return $this->tokenize;
    }

    /**
     * Set the value of tokenize.
     *
     * @since x.y.z
     *
     * @param bool $tokenize
     *
     * @return PaymentTransaction
     */
    public function setShouldTokenize(bool $tokenize) : PaymentTransaction
    {
        $this->tokenize = $tokenize;

        return $this;
    }
}
