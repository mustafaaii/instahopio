<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters\Order;

use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\AbstractOrderItemAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use Mockery;
use ReflectionException;
use WC_Order;
use WC_Order_Item;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\AbstractOrderItemAdapter
 */
class AbstractOrderItemAdapterTest extends WPTestCase
{
    /**
     * Tests that can get the currency from a WooCommerce order item's order.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\AbstractOrderItemAdapter::getCurrency()
     *
     * @throws ReflectionException
     */
    public function testCanGetCurrency()
    {
        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->once()->andReturn('USD');

        $orderItem = Mockery::mock(WC_Order_Item::class);
        $orderItem->shouldReceive('get_order')->once()->andReturn($order);

        $adapter = $this->getInstance($orderItem);
        $method = TestHelpers::getInaccessibleMethod($adapter, 'getCurrency');

        $this->assertEquals('USD', $method->invoke($adapter));
    }

    /**
     * Tests that can convert a WooCommerce order item amount to a native currency amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\AbstractOrderItemAdapter::convertCurrencyAmountFromSource()
     * @dataProvider providerCurrencyAmountsForConversion
     *
     * @param float $sourceAmount
     * @param CurrencyAmount $currencyAmount
     * @throws ReflectionException
     */
    public function testConvertCurrencyAmountFromSource(float $sourceAmount, CurrencyAmount $currencyAmount)
    {
        WP_Mock::userFunction('wc_add_number_precision')->andReturn($currencyAmount->getAmount());

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')
              ->once()
              ->andReturn($currencyAmount->getCurrencyCode());

        $orderItem = Mockery::mock(WC_Order_Item::class);
        $orderItem->shouldReceive('get_order')
                  ->once()
                  ->andReturn($order);

        $adapter = $this->getInstance($orderItem);
        $method = TestHelpers::getInaccessibleMethod($adapter, 'convertCurrencyAmountFromSource');

        /** @var CurrencyAmount $convertedAmount */
        $convertedAmount = $method->invokeArgs($adapter, [$sourceAmount]);

        $this->assertInstanceOf(CurrencyAmount::class, $convertedAmount);
        $this->assertEquals($currencyAmount->getAmount(), $convertedAmount->getAmount());
        $this->assertEquals($currencyAmount->getCurrencyCode(), $convertedAmount->getCurrencyCode());
    }

    /**
     * Tests that can convert a native currency amount into a WooCommerce order item amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\AbstractOrderItemAdapter::convertCurrencyAmountToSource()
     * @dataProvider providerCurrencyAmountsForConversion
     *
     * @param float $sourceAmount
     * @param \GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount $currencyAmount
     * @throws ReflectionException
     */
    public function testConvertCurrencyAmountToSource(float $sourceAmount, CurrencyAmount $currencyAmount)
    {
        WP_Mock::userFunction('wc_remove_number_precision')->andReturn($sourceAmount);

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')
              ->once()
              ->andReturn($currencyAmount->getCurrencyCode());

        $orderItem = Mockery::mock(WC_Order_Item::class);
        $orderItem->shouldReceive('get_order')
                  ->once()
                  ->andReturn($order);

        $adapter = $this->getInstance($orderItem);
        $method = TestHelpers::getInaccessibleMethod($adapter, 'convertCurrencyAmountToSource');

        $this->assertEquals($sourceAmount, $method->invokeArgs($adapter, [$currencyAmount]));
    }

    /** @see AbstractOrderItemAdapterTest tests  */
    public function providerCurrencyAmountsForConversion() : array
    {
        return [
            [1.0, (new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD')],
        ];
    }

    /**
     * Gets an instance of a class implementing the abstract.
     *
     * @param WC_Order_Item $source
     * @return AbstractOrderItemAdapter
     */
    private function getInstance(WC_Order_Item $source) : AbstractOrderItemAdapter
    {
        return new class($source) extends AbstractOrderItemAdapter
        {
            public function __construct(WC_Order_Item $source)
            {
                $this->source = $source;
            }
        };
    }
}
