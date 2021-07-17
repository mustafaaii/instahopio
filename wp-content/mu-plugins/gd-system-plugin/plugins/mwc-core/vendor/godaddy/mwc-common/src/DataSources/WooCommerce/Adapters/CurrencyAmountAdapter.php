<?php

namespace GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters;

use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;

/**
 * Currency amount adapter.
 *
 * @since x.y.x
 */
class CurrencyAmountAdapter implements DataSourceAdapterContract
{
    /** @var float currency amount */
    private $amount;

    /** @var string currency code */
    private $currency;

    /**
     * Currency amount adapter constructor.
     *
     * @since x.y.z
     *
     * @param float $amount
     * @param string $currency
     */
    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Converts a currency amount into a native object.
     *
     * @since x.y.z
     *
     * @return CurrencyAmount
     */
    public function convertFromSource() : CurrencyAmount
    {
        $currencyAmount = new CurrencyAmount();

        return $currencyAmount
            ->setAmount((int) wc_add_number_precision($this->amount))
            ->setCurrencyCode($this->currency);
    }

    /**
     * Converts a currency amount to a float.
     *
     * @since x.y.z
     *
     * @param CurrencyAmount $currencyAmount
     *
     * @return float
     */
    public function convertToSource(CurrencyAmount $currencyAmount = null) : float
    {
        if ($currencyAmount) {
            $this->amount = (float) wc_remove_number_precision($currencyAmount->getAmount());
            $this->currency = $currencyAmount->getCurrencyCode();
        }

        return $this->amount;
    }
}
