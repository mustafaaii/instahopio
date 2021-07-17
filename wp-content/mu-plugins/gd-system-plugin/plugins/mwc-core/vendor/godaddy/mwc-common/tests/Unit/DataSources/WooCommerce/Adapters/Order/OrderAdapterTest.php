<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters\Order;

use DateTime;
use DateTimeZone;
use Exception;
use GoDaddy\WordPress\MWC\Common\Contracts\OrderStatusContract;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\AddressAdapter;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Models\Orders\FeeItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;
use GoDaddy\WordPress\MWC\Common\Models\Orders\ShippingItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\CancelledOrderStatus;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\CompletedOrderStatus;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\FailedOrderStatus;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\HeldOrderStatus;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\PendingOrderStatus;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\ProcessingOrderStatus;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\RefundedOrderStatus;
use GoDaddy\WordPress\MWC\Common\Models\Orders\TaxItem;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use Mockery;
use ReflectionException;
use WC_Order;
use WC_Order_Item;
use WC_Order_Item_Fee;
use WC_Order_Item_Product;
use WC_Order_Item_Shipping;
use WC_Order_Item_Tax;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter
 */
class OrderAdapterTest extends WPTestCase
{
    /**
     * Tests that can set the WooCommerce order object to the source property.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::__construct()
     *
     * @throws ReflectionException
     */
    public function testCanInitializeSource()
    {
        $order = Mockery::mock('WC_Order');
        $adapter = new OrderAdapter($order);
        $source = TestHelpers::getInaccessibleProperty($adapter, 'source');

        $this->assertEquals($order, $source->getValue($adapter));
    }

    /**
     * Tests that can convert a WooCommerce order object to a native order object.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::convertFromSource()
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::convertCurrencyAmountFromSource()
     * @dataProvider providerOrder
     *
     * @param Order $nativeOrder
     * @throws Exception
     */
    public function testCanConvertFromSource(Order $nativeOrder)
    {
        WP_Mock::userFunction('wc_add_number_precision');

        $source = Mockery::mock(WC_Order::class);

        $source->shouldReceive('get_id')->andReturn($nativeOrder->getId());
        $source->shouldReceive('get_order_number')->andReturn($nativeOrder->getNumber());
        $source->shouldReceive('get_status')->andReturn($nativeOrder->getStatus()->getName());
        $source->shouldReceive('get_date_created')->andReturn($nativeOrder->getCreatedAt());
        $source->shouldReceive('get_date_modified')->andReturn($nativeOrder->getUpdatedAt());
        $source->shouldReceive('get_customer_id')->andReturn($nativeOrder->getCustomerId());
        $source->shouldReceive('get_customer_ip_address')->andReturn($nativeOrder->getCustomerIpAddress());
        $source->shouldReceive('get_address')->with('billing')->andReturn((new AddressAdapter([]))->convertToSource($nativeOrder->getBillingAddress()));
        $source->shouldReceive('get_address')->with('shipping')->andReturn((new AddressAdapter([]))->convertToSource($nativeOrder->getShippingAddress()));
        $source->shouldReceive('get_currency')->andReturn('USD');

        /** @see testCanConvertOrderItemsToSource for testing order items specifically */
        $source->shouldReceive('get_items')->andReturn([]);
        $source->shouldReceive('get_subtotal')->andReturn(0);
        $source->shouldReceive('get_shipping_total')->andReturn(0);
        $source->shouldReceive('get_total_fees')->andReturn(0);
        $source->shouldReceive('get_total_tax')->andReturn(0);
        $source->shouldReceive('get_total')->andReturn(0);

        $convertedOrder = (new OrderAdapter($source))->convertFromSource();

        $this->assertEquals($nativeOrder->getId(), $convertedOrder->getId());
        $this->assertEquals($nativeOrder->getNumber(), $convertedOrder->getNumber());
        $this->assertEquals($nativeOrder->getStatus()->getName(), $convertedOrder->getStatus()->getName());
        $this->assertEquals($nativeOrder->getCustomerId(), $convertedOrder->getCustomerId());
        $this->assertEquals($nativeOrder->getCustomerIpAddress(), $convertedOrder->getCustomerIpAddress());
        $this->assertEquals($nativeOrder->getCreatedAt()->format('c'), $convertedOrder->getCreatedAt()->format('c'));
        $this->assertEquals($nativeOrder->getUpdatedAt()->format('c'), $convertedOrder->getUpdatedAt()->format('c'));
        $this->assertEquals($nativeOrder->getBillingAddress(), $convertedOrder->getBillingAddress());
        $this->assertEquals($nativeOrder->getShippingAddress(), $convertedOrder->getShippingAddress());
    }

    /**
     * Tests that can convert WooCommerce order items into native order items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::convertOrderItemsFromSource()
     * @dataProvider providerOrder
     *
     * @param Order $nativeOrder
     * @throws ReflectionException
     */
    public function testCanConvertOrderItemsFromSource(Order $nativeOrder)
    {
        WP_Mock::userFunction('wc_add_number_precision')->andReturn(0);
        WP_Mock::userFunction('wc_remove_number_precision')->andReturn(0);

        $source = Mockery::mock(WC_Order::class);
        $source->shouldReceive('get_currency')->andReturn('USD');

        $nativeFeeItem = current($nativeOrder->getFeeItems());
        $sourceFeeItem = Mockery::namedMock(WC_Order_Item_Fee::class, WC_Order_Item::class);
        $sourceFeeItem->shouldReceive('get_order')->andReturn($source);
        $sourceFeeItem->shouldReceive('get_id')->andReturn($nativeFeeItem->getId());
        $sourceFeeItem->shouldReceive('get_name')->andReturn($nativeFeeItem->getLabel());
        $sourceFeeItem->shouldReceive('get_total_tax')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeFeeItem->getTaxAmount()));
        $sourceFeeItem->shouldReceive('get_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeFeeItem->getTotalAmount()));

        $nativeLineItem = current($nativeOrder->getLineItems());
        $sourceLineItem = Mockery::namedMock(WC_Order_Item_Product::class, WC_Order_Item::class);
        $sourceLineItem->shouldReceive('get_order')->andReturn($source);
        $sourceLineItem->shouldReceive('get_id')->andReturn($nativeLineItem->getId());
        $sourceLineItem->shouldReceive('get_name')->andReturn($nativeLineItem->getLabel());
        $sourceLineItem->shouldReceive('get_quantity')->andReturn($nativeLineItem->getQuantity());
        $sourceLineItem->shouldReceive('get_total_tax')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeLineItem->getTaxAmount()));
        $sourceLineItem->shouldReceive('get_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeLineItem->getTotalAmount()));

        $nativeShippingItem = current($nativeOrder->getShippingItems());
        $sourceShippingItem = Mockery::namedMock(WC_Order_Item_Shipping::class, WC_Order_Item::class);
        $sourceShippingItem->shouldReceive('get_order')->andReturn($source);
        $sourceShippingItem->shouldReceive('get_id')->andReturn($nativeShippingItem->getId());
        $sourceShippingItem->shouldReceive('get_name')->andReturn($nativeShippingItem->getLabel());
        $sourceShippingItem->shouldReceive('get_total_tax')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeShippingItem->getTaxAmount()));
        $sourceShippingItem->shouldReceive('get_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeShippingItem->getTotalAmount()));

        $nativeTaxItem = current($nativeOrder->getTaxItems());
        $sourceTaxItem =  Mockery::namedMock(WC_Order_Item_Tax::class, WC_Order_Item::class);
        $sourceTaxItem->shouldReceive('get_order')->andReturn($source);
        $sourceTaxItem->shouldReceive('get_id')->andReturn($nativeTaxItem->getId());
        $sourceTaxItem->shouldReceive('get_label')->andReturn($nativeTaxItem->getLabel());
        $sourceTaxItem->shouldReceive('get_rate_code')->andReturn($nativeTaxItem->getName());
        $sourceTaxItem->shouldReceive('get_rate_percent')->andReturn($nativeTaxItem->getRate());
        $sourceTaxItem->shouldReceive('get_tax_total')->andReturn((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeTaxItem->getTotalAmount()));

        $source->shouldReceive('get_items')->with('fee')->andReturn([$sourceFeeItem]);
        $source->shouldReceive('get_items')->with('line_item')->andReturn([$sourceLineItem]);
        $source->shouldReceive('get_items')->with('shipping')->andReturn([$sourceShippingItem]);
        $source->shouldReceive('get_items')->with('tax')->andReturn([$sourceTaxItem]);

        $adapter = new OrderAdapter($source);
        $method = TestHelpers::getInaccessibleMethod($adapter, 'convertOrderItemsFromSource');

        /** @var Order $converted */
        $converted = $method->invokeArgs($adapter, [$nativeOrder]);

        $this->assertInstanceOf(get_class($nativeOrder), $converted);
        $this->assertCount(1, $converted->getFeeItems());
        $this->assertEquals($nativeFeeItem->getId(), current($converted->getFeeItems())->getId());
        $this->assertEquals($nativeFeeItem->getLabel(), current($converted->getFeeItems())->getLabel());
        $this->assertEquals($nativeFeeItem->getTaxAmount(), current($converted->getFeeItems())->getTaxAmount());
        $this->assertEquals($nativeFeeItem->getTotalAmount(), current($converted->getFeeItems())->getTotalAmount());
        $this->assertCount(1, $converted->getLineItems());
        $this->assertEquals($nativeLineItem->getId(), current($converted->getLineItems())->getId());
        $this->assertEquals($nativeLineItem->getLabel(), current($converted->getLineItems())->getLabel());
        $this->assertEquals($nativeLineItem->getQuantity(), current($converted->getLineItems())->getQuantity());
        $this->assertEquals($nativeLineItem->getTaxAmount(), current($converted->getLineItems())->getTaxAmount());
        $this->assertEquals($nativeLineItem->getTotalAmount(), current($converted->getLineItems())->getTotalAmount());
        $this->assertCount(1, $converted->getShippingItems());
        $this->assertEquals($nativeShippingItem->getId(), current($converted->getShippingItems())->getId());
        $this->assertEquals($nativeShippingItem->getLabel(), current($converted->getShippingItems())->getLabel());
        $this->assertEquals($nativeShippingItem->getTaxAmount(), current($converted->getShippingItems())->getTaxAmount());
        $this->assertEquals($nativeShippingItem->getTotalAmount(), current($converted->getShippingItems())->getTotalAmount());
        $this->assertCount(1, $converted->getTaxItems());
        $this->assertEquals($nativeTaxItem->getId(), current($converted->getTaxItems())->getId());
        $this->assertEquals($nativeTaxItem->getLabel(), current($converted->getTaxItems())->getLabel());
        $this->assertEquals($nativeTaxItem->getName(), current($converted->getTaxItems())->getName());
        $this->assertEquals($nativeTaxItem->getRate(), current($converted->getTaxItems())->getRate());
        $this->assertEquals($nativeTaxItem->getTotalAmount(), current($converted->getTaxItems())->getTotalAmount());
    }

    /**
     * Tests that source statuses are correctly converted.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::convertStatusFromSource()
     *
     * @param string $sourceStatus
     * @param string $expectedClass
     *
     * @dataProvider providerConvertStatusFromSource
     *
     * @throws ReflectionException
     */
    public function testCanConvertStatusFromSource(string $sourceStatus, string $expectedClass)
    {
        $source = Mockery::mock(WC_Order::class);
        $source->shouldReceive('get_status')->andReturn($sourceStatus);

        $adapter = new OrderAdapter($source);

        $reflectionMethod = TestHelpers::getInaccessibleMethod($adapter, 'convertStatusFromSource');

        $this->assertInstanceOf($expectedClass, $reflectionMethod->invoke($adapter));
    }

    /**
     * @see testCanConvertStatusFromSource
     *
     * @return array
     */
    public function providerConvertStatusFromSource() : array
    {
        return [
            ['cancelled', CancelledOrderStatus::class],
            ['completed', CompletedOrderStatus::class],
            ['failed', FailedOrderStatus::class],
            ['on-hold', HeldOrderStatus::class],
            ['pending', PendingOrderStatus::class],
            ['processing', ProcessingOrderStatus::class],
            ['refunded', RefundedOrderStatus::class],
        ];
    }

    /**
     * Tests that unknown source statuses are correctly converted.
     *
     * @throws ReflectionException
     */
    public function testCanConvertUnknownStatusFromSource()
    {
        $source = Mockery::mock(WC_Order::class);
        $source->shouldReceive('get_status')->andReturn('unknown');

        $adapter = new OrderAdapter($source);

        $reflectionMethod = TestHelpers::getInaccessibleMethod($adapter, 'convertStatusFromSource');

        $this->assertNull($reflectionMethod->invoke($adapter));
    }

    /**
     * Tests that can convert a native order object to a WooCommerce order object.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::convertToSource()
     * @dataProvider providerOrder
     *
     * @param Order $order
     * @throws Exception
     */
    public function testCanConvertToSource(Order $order)
    {
        /** @see testCanConvertOrderItemsToSource for coverage of order items specifically */
        $order->setFeeItems([]);
        $order->setLineItems([]);
        $order->setShippingItems([]);
        $order->setTaxItems([]);

        $source = Mockery::mock(WC_Order::class);
        $source->expects('set_id')->with($order->getId());
        $source->expects('set_status')->with($order->getStatus()->getName());
        $source->expects('set_customer_id')->with($order->getCustomerId());
        $source->expects('set_customer_ip_address')->with($order->getCustomerIpAddress());
        $source->expects('set_date_created')->with($order->getCreatedAt()->setTimezone(new DateTimeZone('UTC'))->getTimestamp());
        $source->expects('set_date_modified')->with($order->getUpdatedAt()->setTimezone(new DateTimeZone('UTC'))->getTimestamp());
        $source->expects('set_address')->withArgs([(new AddressAdapter([]))->convertToSource($order->getBillingAddress()), 'billing']);
        $source->expects('set_address')->withArgs([(new AddressAdapter([]))->convertToSource($order->getShippingAddress()), 'shipping']);
        $source->expects('calculate_totals');

        $this->assertInstanceOf(get_class($source), (new OrderAdapter($source))->convertToSource($order));
    }

    /**
     * Tests that can convert native order items to WooCommerce order items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::convertOrderItemsToSource()
     * @dataProvider providerOrder
     *
     * @param Order $nativeOrder
     * @throws ReflectionException
     */
    public function testCanConvertOrderItemsToSource(Order $nativeOrder)
    {
        WP_Mock::userFunction('wc_remove_number_precision')->andReturn(0);

        $source = Mockery::mock(WC_Order::class);
        $source->shouldReceive('get_currency')->andReturn('USD');

        $nativeFeeItem = current($nativeOrder->getFeeItems());
        $sourceFeeItem = Mockery::namedMock(WC_Order_Item_Fee::class, WC_Order_Item::class);
        $sourceFeeItem->shouldReceive('get_order')->andReturn($source);
        $sourceFeeItem->shouldReceive('set_id')->with($nativeFeeItem->getId());
        $sourceFeeItem->shouldReceive('set_name')->with($nativeFeeItem->getLabel());
        $sourceFeeItem->shouldReceive('set_total_tax')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeFeeItem->getTaxAmount()));
        $sourceFeeItem->shouldReceive('set_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeFeeItem->getTotalAmount()));

        $nativeLineItem = current($nativeOrder->getLineItems());
        $sourceLineItem = Mockery::namedMock(WC_Order_Item_Product::class, WC_Order_Item::class);
        $sourceLineItem->shouldReceive('get_order')->andReturn($source);
        $sourceLineItem->shouldReceive('set_id')->with($nativeLineItem->getId());
        $sourceLineItem->shouldReceive('set_name')->with($nativeLineItem->getLabel());
        $sourceLineItem->shouldReceive('set_quantity')->with($nativeLineItem->getQuantity());
        $sourceLineItem->shouldReceive('set_total_tax')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeLineItem->getTaxAmount()));
        $sourceLineItem->shouldReceive('set_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeLineItem->getTotalAmount()));

        $nativeShippingItem = current($nativeOrder->getShippingItems());
        $sourceShippingItem = Mockery::namedMock(WC_Order_Item_Shipping::class, WC_Order_Item::class);
        $sourceShippingItem->shouldReceive('get_order')->andReturn($source);
        $sourceShippingItem->shouldReceive('set_id')->with($nativeShippingItem->getId());
        $sourceShippingItem->shouldReceive('set_name')->with($nativeShippingItem->getLabel());
        $sourceShippingItem->shouldReceive('set_total_tax')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeShippingItem->getTaxAmount()));
        $sourceShippingItem->shouldReceive('set_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeShippingItem->getTotalAmount()));

        $nativeTaxItem = current($nativeOrder->getTaxItems());
        $sourceTaxItem = Mockery::namedMock(WC_Order_Item_Tax::class, WC_Order_Item::class);
        $sourceTaxItem->shouldReceive('get_order')->andReturn($source);
        $sourceTaxItem->shouldReceive('set_id')->with($nativeTaxItem->getId());
        $sourceTaxItem->shouldReceive('set_label')->with($nativeTaxItem->getLabel());
        $sourceTaxItem->shouldReceive('set_rate_code')->with($nativeTaxItem->getName());
        $sourceTaxItem->shouldReceive('set_rate_percent')->with($nativeTaxItem->getRate());
        $sourceTaxItem->shouldReceive('set_tax_total')->with((new CurrencyAmountAdapter(0.0, 'USD'))->convertToSource($nativeTaxItem->getTotalAmount()));

        $source->expects('add_item')->with($sourceFeeItem);
        $source->expects('add_item')->with($sourceLineItem);
        $source->expects('add_item')->with($sourceShippingItem);
        $source->expects('add_item')->with($sourceTaxItem);

        $mockAdapter = $this->getMockBuilder(OrderAdapter::class)
                            ->setConstructorArgs([$source])
                            ->onlyMethods(['getWooCommerceOrderItemInstance'])
                            ->getMock();

        $mockAdapter->expects($this->exactly(4))
                    ->method('getWooCommerceOrderItemInstance')
                    ->withConsecutive([WC_Order_Item_Fee::class], [WC_Order_Item_Product::class], [WC_Order_Item_Shipping::class], [WC_Order_Item_Tax::class])
                    ->willReturnOnConsecutiveCalls($sourceFeeItem, $sourceLineItem, $sourceShippingItem, $sourceTaxItem);

        $method = TestHelpers::getInaccessibleMethod($mockAdapter, 'convertOrderItemsToSource');

        $method->invokeArgs($mockAdapter, [$nativeOrder]);
    }

    /**
     * Tests that the given status can be converted to source.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::testCanConvertStatusToSource()
     *
     * @param OrderStatusContract $status
     * @param string              $expected
     *
     * @dataProvider providerConvertStatusToSource
     *
     * @throws ReflectionException
     */
    public function testCanConvertStatusToSource(OrderStatusContract $status, string $expected)
    {
        $source  = Mockery::mock(WC_Order::class);
        $adapter = new OrderAdapter($source);
        $method  = TestHelpers::getInaccessibleMethod($adapter, 'convertStatusToSource');

        $this->assertSame($expected, $method->invoke($adapter, $status));
    }

    /**
     * @see testCanConvertStatusToSource
     *
     * @return array
     */
    public function providerConvertStatusToSource() : array
    {
        $unknownStatus = new class() implements OrderStatusContract {
            use HasLabelTrait;

            public function __construct(){
                $this->name = 'unknown';
            }
        };

        return [
            [new ProcessingOrderStatus(), 'processing'],
            [$unknownStatus, 'unknown'],
        ];
    }

    /**
     * Tests that can get the WooCommerce order item instance.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter::getWooCommerceOrderItemInstance()
     * @dataProvider providerGetWooCommerceOrderItemClassNames
     *
     * @param string $className
     */
    public function testCanGetWooCommerceOrderItemInstance(string $className)
    {
        $adapter = new OrderAdapter(Mockery::mock(WC_Order::class));
        $orderItem = Mockery::namedMock($className, WC_Order_Item::class);

        $this->assertInstanceOf(get_class($orderItem), $adapter->getWooCommerceOrderItemInstance($className));
    }

    /** @see testCanGetWooCommerceOrderItemInstance */
    public function providerGetWooCommerceOrderItemClassNames() : array
    {
        return [
            [WC_Order_Item_Fee::class],
            [WC_Order_Item_Product::class],
            [WC_Order_Item_Shipping::class],
            [WC_Order_Item_Tax::class],
        ];
    }

    /** @see OrderAdapterTests tests */
    public function providerOrder() : array
    {
        $address = (new AddressAdapter([
            'company'    => 'SkyVerge',
            'first_name' => 'Barb',
            'last_name'  => 'DeBear',
            'address_1'  => '177 Huntington Ave',
            'address_2'  => 'Ste 1703 #70640',
            'city'       => 'Boston',
            'state'      => 'MA',
            'postcode'   => '02115-3153',
            'country'    => 'US'
        ]))->convertFromSource();

        $amount = (new CurrencyAmount())->setAmount(0)->setCurrencyCode('USD');

        $feeItem = (new FeeItem())
            ->setId(111)
            ->setLabel('Fee Item')
            ->setName('fee-item')
            ->setTaxAmount($amount)
            ->setTotalAmount($amount);

        $lineItem = (new LineItem())
            ->setId(222)
            ->setLabel('Line Item')
            ->setName('line-item')
            ->setQuantity(1)
            ->setTaxAmount($amount)
            ->setTotalAmount($amount);

        $shippingItem = (new ShippingItem())
            ->setId(333)
            ->setLabel('Shipping Item')
            ->setName('shipping-item')
            ->setTaxAmount($amount)
            ->setTotalAmount($amount);

        $taxItem = (new TaxItem())
            ->setId(444)
            ->setLabel('Tax Item')
            ->setName('tax-item')
            ->setRate(10.0)
            ->setTotalAmount($amount);

        $order = (new Order())
            ->setId(123)
            ->setNumber('123')
            ->setCustomerId(456)
            ->setCustomerIpAddress('127.0.0.1')
            ->setStatus(new ProcessingOrderStatus())
            ->setCreatedAt(new DateTime('yesterday'))
            ->setUpdatedAt(new DateTime('now'))
            ->setBillingAddress($address)
            ->setShippingAddress($address)
            ->setFeeItems([$feeItem])
            ->setFeeAmount($amount)
            ->setLineItems([$lineItem])
            ->setLineAmount($amount)
            ->setShippingItems([$shippingItem])
            ->setShippingAmount($amount)
            ->setTaxItems([$taxItem])
            ->setTaxAmount($amount)
            ->setTotalAmount($amount);

        return [
            [$order],
        ];
    }
}
