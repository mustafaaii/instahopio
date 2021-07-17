<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters\Order;

use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\FeeItemAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Models\Orders\FeeItem;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use Mockery;
use WC_Order;
use WC_Order_Item;
use WC_Order_Item_Fee;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\FeeItemAdapter
 */
class FeeItemAdapterTest extends WPTestCase
{
    /**
     * Tests that can convert a WooCommerce order fee item to a native order fee item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\FeeItemAdapter::convertFromSource()
     * @dataProvider providerFeeItem
     *
     * @param FeeItem $feeItem
     */
    public function testCanConvertFromSource(FeeItem $feeItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Fee::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('get_id')->andReturn($feeItem->getId());
        $source->shouldReceive('get_name')->andReturn($feeItem->getLabel());
        $source->shouldReceive('get_total_tax')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($feeItem->getTaxAmount()));
        $source->shouldReceive('get_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($feeItem->getTotalAmount()));

        $converted = (new FeeItemAdapter($source))->convertFromSource();

        $this->assertEquals($feeItem->getId(), $converted->getId());
        $this->assertEquals($feeItem->getLabel(), $converted->getLabel());
    }

    /**
     * Tests that can convert a native order fee item to a WooCommerce order fee item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\FeeItemAdapter::convertToSource()
     * @dataProvider providerFeeItem
     *
     * @param FeeItem $feeItem
     */
    public function testCanConvertToSource(FeeItem $feeItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Fee::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('set_id')->with($feeItem->getId());
        $source->shouldReceive('set_name')->with($feeItem->getLabel());
        $source->shouldReceive('set_total_tax')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($feeItem->getTaxAmount()));
        $source->shouldReceive('set_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($feeItem->getTotalAmount()));

        $this->assertInstanceOf(get_class($source), (new FeeItemAdapter($source))->convertToSource($feeItem));
    }

    /** @see FeeItemAdapterTest tests  */
    public function providerFeeItem() : array
    {
        $feeItem = (new FeeItem())
            ->setId(1)
            ->setName('test-name')
            ->setLabel('Test Name')
            ->setTaxAmount((new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD'))
            ->setTotalAmount((new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD'));

        return [
            [$feeItem]
        ];
    }
}
