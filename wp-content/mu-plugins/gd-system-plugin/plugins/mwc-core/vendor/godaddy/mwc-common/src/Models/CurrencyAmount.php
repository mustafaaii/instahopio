<?php

namespace GoDaddy\WordPress\MWC\Common\Models;

/**
 * An object representation of a currency amount.
 *
 * @since x.y.z
 */
class CurrencyAmount
{
    /** @var int $amount in cents */
    private $amount;

    /** @var string $currencyCode 2-letter Unicode CLDR currency code */
    private $currencyCode;

    /**
     * Gets the amount.
     *
     * @since x.y.z
     *
     * @return int cents
     */
    public function getAmount() : int
    {
        return is_int($this->amount) ? $this->amount : 0;
    }

    /**
     * Gets the currency code.
     *
     * @since x.y.z
     *
     * @return string 3-letter Unicode CLDR currency code
     */
    public function getCurrencyCode() : string
    {
        return is_string($this->currencyCode) ? $this->currencyCode : '';
    }

    /**
     * Sets the amount.
     *
     * @since x.y.z
     *
     * @param int $amount
     *
     * @return self
     */
    public function setAmount(int $amount) : CurrencyAmount
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Sets the currency code.
     *
     * @since x.y.z
     *
     * @param string $code 3-letter Unicode CLDR currency code
     *
     * @return self
     */
    public function setCurrencyCode(string $code) : CurrencyAmount
    {
        $this->currencyCode = $code;

        return $this;
    }
}
