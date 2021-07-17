<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters\Order;

use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\LineItemAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use Mockery;
use WC_Order;
use WC_Order_Item;
use WC_Order_Item_Product;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\LineItemAdapter
 */
class LineItemAdapterTest extends WPTestCase
{
    /**
     * Tests that can convert a WooCommerce order product item to a native order line item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\LineItemAdapter::convertFromSource()
     * @dataProvider providerLineItem
     *
     * @param LineItem $lineItem
     */
    public function testCanConvertFromSource(LineItem $lineItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Product::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('get_id')->andReturn($lineItem->getId());
        $source->shouldReceive('get_name')->andReturn($lineItem->getLabel());
        $source->shouldReceive('get_quantity')->andReturn($lineItem->getQuantity());
        $source->shouldReceive('get_total_tax')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($lineItem->getTaxAmount()));
        $source->shouldReceive('get_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($lineItem->getTotalAmount()));

        $converted = (new LineItemAdapter($source))->convertFromSource();

        $this->assertEquals($lineItem->getId(), $converted->getId());
        $this->assertEquals($lineItem->getLabel(), $converted->getLabel());
        $this->assertEquals($lineItem->getQuantity(), $converted->getQuantity());
    }

    /**
     * Tests that can convert a native order line item to a WooCommerce order product item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\LineItemAdapter::convertToSource()
     * @dataProvider providerLineItem
     *
     * @param LineItem $lineItem
     */
    public function testCanConvertToSource(LineItem $lineItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Product::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('set_id')->with($lineItem->getId());
        $source->shouldReceive('set_name')->with($lineItem->getLabel());
        $source->shouldReceive('set_quantity')->with($lineItem->getQuantity());
        $source->shouldReceive('set_total_tax')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($lineItem->getTaxAmount()));
        $source->shouldReceive('set_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($lineItem->getTotalAmount()));

        $this->assertInstanceOf(get_class($source), (new LineItemAdapter($source))->convertToSource($lineItem));
    }

    /** @see LineItemAdapterTest tests  */
    public function providerLineItem() : array
    {
        $lineItem = (new LineItem())
            ->setId(1)
            ->setName('test-name')
            ->setLabel('Test Name')
            ->setQuantity(1)
            ->setTaxAmount((new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD'))
            ->setTotalAmount((new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD'));

        return [
            [$lineItem]
        ];
    }
}
