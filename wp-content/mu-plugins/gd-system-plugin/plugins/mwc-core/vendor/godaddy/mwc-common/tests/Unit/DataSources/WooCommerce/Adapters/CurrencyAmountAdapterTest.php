<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters;

use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use ReflectionException;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter
 */
final class CurrencyAmountAdapterTest extends WPTestCase
{
    /**
     * Tests that can set source data.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter::__construct()
     *
     * @throws ReflectionException
     */
    public function testCanSetSource()
    {
        $adapter = new CurrencyAmountAdapter(1.00, 'USD');
        $sourceAmount = TestHelpers::getInaccessibleProperty($adapter, 'amount');
        $sourceCurrency = TestHelpers::getInaccessibleProperty($adapter, 'currency');

        $this->assertEquals(1.00, $sourceAmount->getValue($adapter));
        $this->assertEquals('USD', $sourceCurrency->getValue($adapter));
    }

    /**
     * Tests that can convert a currency amount as float and currency code to a native object representation of a currency amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter::convertFromSource()
     * @dataProvider providerCurrencyAmount
     *
     * @param float $amount
     * @param string $currency
     * @param int $toCents
     */
    public function testCanConvertFromSource(float $amount, string $currency, int $toCents)
    {
        WP_Mock::userFunction('wc_add_number_precision')->andReturn($toCents);

        $adapter = new CurrencyAmountAdapter($amount, $currency);
        $currencyAmount = $adapter->convertFromSource();

        $this->assertEquals($toCents, $currencyAmount->getAmount());
        $this->assertEquals($currency, $currencyAmount->getCurrencyCode());
    }

    /**
     * Tests that can convert a currency amount to float.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter::convertToSource()
     * @dataProvider providerCurrencyAmount
     *
     * @param float $amount
     * @param string $currency
     * @param int $toCents
     */
    public function testCanConvertToSource(float $amount, string $currency, int $toCents)
    {
        WP_Mock::userFunction('wc_remove_number_precision')->andReturn($amount);

        $adapter = new CurrencyAmountAdapter(0.00, 'USD');
        $currencyAmount = (new CurrencyAmount())->setAmount($toCents)->setCurrencyCode($currency);

        $this->assertEquals($amount, $adapter->convertToSource($currencyAmount));
    }

    /** @see CurrencyAmountAdapterTest cases */
    public function providerCurrencyAmount() : array
    {
        return [
            [0.001, 'BTC', 0],
            [0.009, 'ETH', 1],
            [0.01, 'EUR', 1],
            [0.16, 'GBP', 16],
            [1.0, 'USD', 100],
            [100.01, 'NTD', 10001],
            [123.456, 'VND', 12346],
        ];
    }
}



