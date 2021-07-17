<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters\Order;

use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\TaxItemAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Models\Orders\TaxItem;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use Mockery;
use WC_Order;
use WC_Order_Item;
use WC_Order_Item_Tax;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\TaxItemAdapter
 */
class TaxItemAdapterTest extends WPTestCase
{
    /**
     * Tests that can convert a WooCommerce order tax item to a native order tax item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\TaxItemAdapter::convertFromSource()
     * @dataProvider providerTaxItem
     *
     * @param TaxItem $taxItem
     */
    public function testCanConvertFromSource(TaxItem $taxItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Tax::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('get_id')->andReturn($taxItem->getId());
        $source->shouldReceive('get_label')->andReturn($taxItem->getLabel());
        $source->shouldReceive('get_rate_code')->andReturn($taxItem->getName());
        $source->shouldReceive('get_rate_percent')->andReturn($taxItem->getRate());
        $source->shouldReceive('get_tax_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($taxItem->getTotalAmount()));

        $converted = (new TaxItemAdapter($source))->convertFromSource();

        $this->assertEquals($taxItem->getId(), $converted->getId());
        $this->assertEquals($taxItem->getLabel(), $converted->getLabel());
    }

    /**
     * Tests that can convert a native order tax item to a WooCommerce order tax item.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\TaxItemAdapter::convertToSource()
     * @dataProvider providerTaxItem
     *
     * @param TaxItem $taxItem
     */
    public function testCanConvertToSource(TaxItem $taxItem)
    {
        WP_Mock::userFunction('wc_add_number_precision');
        WP_Mock::userFunction('wc_remove_number_precision');

        $order = Mockery::mock(WC_Order::class);
        $order->shouldReceive('get_currency')->andReturn('USD');

        $source = Mockery::namedMock(WC_Order_Item_Tax::class, WC_Order_Item::class);
        $source->shouldReceive('get_order')->andReturn($order);
        $source->shouldReceive('set_id')->with($taxItem->getId());
        $source->shouldReceive('set_label')->with($taxItem->getLabel());
        $source->shouldReceive('set_rate_code')->with($taxItem->getName());
        $source->shouldReceive('set_rate_percent')->with($taxItem->getRate());
        $source->shouldReceive('set_tax_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($taxItem->getTotalAmount()));

        $this->assertInstanceOf(get_class($source), (new TaxItemAdapter($source))->convertToSource($taxItem));
    }

    /** @see TaxItemAdapterTest tests  */
    public function providerTaxItem() : array
    {
        $taxItem = (new TaxItem())
            ->setId(1)
            ->setName('test-name')
            ->setLabel('Test Name')
            ->setRate(20.0)
            ->setTotalAmount((new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD'));

        return [
            [$taxItem]
        ];
    }
}
