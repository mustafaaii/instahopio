<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters\Order;

use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\FeeItemAdapter;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\ShippingItemAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Models\Orders\ShippingItem;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use Mockery;
use WC_Order;
use WC_Order_Item;
use WC_Order_Item_Shipping;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\ShippingItemAdapter
 */
class ShippingItemAdapterTest extends WPTestCase
{
    /**
     * Tests that can convert a WooCommerce order shipping item to a native order shipping item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\ShippingItemAdapter::convertFromSource()
     * @dataProvider providerShippingItem
     *
     * @param ShippingItem $shippingItem
     */
    public function testCanConvertFromSource(ShippingItem $shippingItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Shipping::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('get_id')->andReturn($shippingItem->getId());
        $source->shouldReceive('get_name')->andReturn($shippingItem->getLabel());
        $source->shouldReceive('get_total_tax')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($shippingItem->getTaxAmount()));
        $source->shouldReceive('get_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($shippingItem->getTotalAmount()));

        $converted = (new ShippingItemAdapter($source))->convertFromSource();

        $this->assertEquals($shippingItem->getId(), $converted->getId());
        $this->assertEquals($shippingItem->getLabel(), $converted->getLabel());
    }

    /**
     * Tests that can convert a native order shipping item to a WooCommerce order shipping item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\ShippingItemAdapter::convertToSource()
     * @dataProvider providerShippingItem
     *
     * @param ShippingItem $shippingItem
     */
    public function testCanConvertToSource(ShippingItem $shippingItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Shipping::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('set_id')->with($shippingItem->getId());
        $source->shouldReceive('set_name')->with($shippingItem->getLabel());
        $source->shouldReceive('set_total_tax')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($shippingItem->getTaxAmount()));
        $source->shouldReceive('set_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($shippingItem->getTotalAmount()));

        $this->assertInstanceOf(get_class($source), (new ShippingItemAdapter($source))->convertToSource($shippingItem));
    }

    /** @see ShippingItemAdapterTest tests  */
    public function providerShippingItem() : array
    {
        $shippingItem = (new ShippingItem())
            ->setId(1)
            ->setName('test-name')
            ->setLabel('Test Name')
            ->setTaxAmount((new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD'))
            ->setTotalAmount((new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD'));

        return [
            [$shippingItem]
        ];
    }
}
