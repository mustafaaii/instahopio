<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders;

use DateTime;
use GoDaddy\WordPress\MWC\Common\Contracts\OrderStatusContract;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Models\Orders\FeeItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;
use GoDaddy\WordPress\MWC\Common\Models\Orders\ShippingItem;
use GoDaddy\WordPress\MWC\Common\Models\Orders\TaxItem;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order
 */
class OrderTest extends TestCase
{
    /**
     * Tests that can get the order ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getId()
     */
    public function testCanGetId()
    {
        $order = new Order();

        $this->assertNull($order->getId());

        $order->setId(123);

        $this->assertEquals(123, $order->getId());
    }

    /**
     * Tests that can get the order number.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getNumber()
     */
    public function testCanGetNumber()
    {
        $order = new Order();

        $this->assertEquals('', $order->getNumber());

        $order->setNumber('123');

        $this->assertEquals('123', $order->getNumber());
    }

    /**
     * Tests that can get the order status.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getStatus()
     */
    public function testCanGetStatus()
    {
        $order = new Order();

        $this->assertNull($order->getStatus());

        $status = $this->getMockOrderStatus();
        $order->setStatus($status);

        $this->assertEquals($status, $order->getStatus());
    }

    /**
     * Tests that can get the order created at.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getCreatedAt()
     */
    public function testCanGetCreatedAt()
    {
        $order = new Order();

        $this->assertNull($order->getCreatedAt());

        $date = new DateTime('now');
        $order->setCreatedAt($date);

        $this->assertEquals($date, $order->getCreatedAt());
    }

    /**
     * Tests that can get the order updated at.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getUpdatedAt()
     */
    public function testCanGetUpdatedAt()
    {
        $order = new Order();

        $this->assertNull($order->getUpdatedAt());

        $date = new DateTime('now');
        $order->setUpdatedAt($date);

        $this->assertEquals($date, $order->getUpdatedAt());
    }

    /**
     * Tests that can get the customer ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getCustomerId()
     */
    public function testCanGeCustomerId()
    {
        $order = new Order();

        $this->assertEquals(0, $order->getCustomerId());

        $order->setCustomerId(123);

        $this->assertEquals(123, $order->getCustomerId());
    }

    /**
     * Tests that can get the customer IP address.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getCustomerIpAddress()
     */
    public function testCanGetCustomerIpAddress()
    {
        $order = new Order();

        $this->assertEquals('', $order->getCustomerIpAddress());

        $order->setCustomerIpAddress('127.0.0.1');

        $this->assertEquals('127.0.0.1', $order->getCustomerIpAddress());
    }

    /**
     * Tests that can get the order line items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getLineItems()
     */
    public function testCanGetLineItems()
    {
        $order = new Order();

        $this->assertEquals([], $order->getLineItems());

        $items = [new LineItem(), new LineItem()];
        $order->setLineItems($items);

        $this->assertEquals($items, $order->getLineItems());
    }

    /**
     * Tests that can get the order line items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getLineAmount()
     */
    public function testCanGetLineAmount()
    {
        $order = new Order();

        $this->assertNull($order->getLineAmount());

        $amount = new CurrencyAmount();
        $order->setLineAmount($amount);

        $this->assertEquals($amount, $order->getLineAmount());
    }

    /**
     * Tests that can get the order shipping items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getShippingItems()
     */
    public function testCanGetShippingItems()
    {
        $order = new Order();

        $this->assertEquals([], $order->getShippingItems());

        $items = [new ShippingItem(), new ShippingItem()];
        $order->setShippingItems($items);

        $this->assertEquals($items, $order->getShippingItems());
    }

    /**
     * Tests that can get the order shipping items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getShippingAmount()
     */
    public function testCanGetShippingAmount()
    {
        $order = new Order();

        $this->assertNull($order->getShippingAmount());

        $amount = new CurrencyAmount();
        $order->setShippingAmount($amount);

        $this->assertEquals($amount, $order->getShippingAmount());
    }

    /**
     * Tests that can get the order fee items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getFeeItems()
     */
    public function testCanGetFeeItems()
    {
        $order = new Order();

        $this->assertEquals([], $order->getFeeItems());

        $items = [new FeeItem(), new FeeItem()];
        $order->setFeeItems($items);

        $this->assertEquals($items, $order->getFeeItems());
    }

    /**
     * Tests that can get the order fee items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getFeeAmount()
     */
    public function testCanGetFeeAmount()
    {
        $order = new Order();

        $this->assertNull($order->getFeeAmount());

        $amount = new CurrencyAmount();
        $order->setFeeAmount($amount);

        $this->assertEquals($amount, $order->getFeeAmount());
    }

    /**
     * Tests that can get the order tax items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getTaxItems()
     */
    public function testCanGetTaxItems()
    {
        $order = new Order();

        $this->assertEquals([], $order->getTaxItems());

        $items = [new TaxItem(), new TaxItem()];
        $order->setTaxItems($items);

        $this->assertEquals($items, $order->getTaxItems());
    }

    /**
     * Tests that can get the order tax items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getTaxAmount()
     */
    public function testCanGetTaxAmount()
    {
        $order = new Order();

        $this->assertNull($order->getTaxAmount());

        $amount = new CurrencyAmount();
        $order->setTaxAmount($amount);

        $this->assertEquals($amount, $order->getTaxAmount());
    }

    /**
     * Tests that can get the order total amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::getTotalAmount()
     */
    public function testCanGetTotalAmount()
    {
        $order = new Order();

        $this->assertNull($order->getTotalAmount());

        $amount = new CurrencyAmount();
        $order->setTotalAmount($amount);

        $this->assertEquals($amount, $order->getTotalAmount());
    }

    /**
     * Tests that can set the order ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setId()
     *
     * @throws ReflectionException
     */
    public function testCanSetId()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'id');

        $this->assertNull($property->getValue($order));

        $order->setId(123);

        $this->assertEquals(123, $property->getValue($order));
    }

    /**
     * Tests that can set the order number.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setNumber()
     *
     * @throws ReflectionException
     */
    public function testCanSetNumber()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'number');

        $this->assertNull($property->getValue($order));

        $order->setNumber('123');

        $this->assertEquals('123', $property->getValue($order));
    }

    /**
     * Tests that can set the order status.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setStatus()
     *
     * @throws ReflectionException
     */
    public function testCanSetStatus()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'status');

        $this->assertNull($property->getValue($order));

        $status = $this->getMockOrderStatus();
        $order->setStatus($status);

        $this->assertEquals($status, $property->getValue($order));
    }

    /**
     * Tests that can set the order created at.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setCreatedAt()
     *
     * @throws ReflectionException
     */
    public function testCanSetCreatedAt()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'createdAt');

        $this->assertNull($property->getValue($order));

        $date = new DateTime('now');
        $order->setCreatedAt($date);

        $this->assertEquals($date, $property->getValue($order));
    }

    /**
     * Tests that can set the order updated at.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setUpdatedAt()
     *
     * @throws ReflectionException
     */
    public function testCanSetUpdatedAt()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'updatedAt');

        $this->assertNull($property->getValue($order));

        $date = new DateTime('now');
        $order->setUpdatedAt($date);

        $this->assertEquals($date, $property->getValue($order));
    }

    /**
     * Tests that can set the customer ID.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setCustomerId()
     *
     * @throws ReflectionException
     */
    public function testCanSetCustomerId()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'customerId');

        $this->assertNull($property->getValue($order));

        $order->setCustomerId(123);

        $this->assertEquals(123, $property->getValue($order));
    }

    /**
     * Tests that can set the customer IP address.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setCustomerIpAddress()
     *
     * @throws ReflectionException
     */
    public function testCanSetCustomerIpAddress()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'customerIpAddress');

        $this->assertNull($property->getValue($order));

        $order->setCustomerIpAddress('127.0.0.1');

        $this->assertEquals('127.0.0.1', $property->getValue($order));
    }

    /**
     * Tests that can set the order line items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setLineItems()
     *
     * @throws ReflectionException
     */
    public function testCanSetLineItems()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'lineItems');

        $this->assertEquals([], $property->getValue($order));

        $items = [new LineItem(), new LineItem()];
        $order->setLineItems($items);

        $this->assertEquals($items, $property->getValue($order));
    }

    /**
     * Tests that can set the order line items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setLineAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetLineAmount()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'lineAmount');

        $this->assertNull($property->getValue($order));

        $amount = new CurrencyAmount();
        $order->setLineAmount($amount);

        $this->assertEquals($amount, $property->getValue($order));
    }

    /**
     * Tests that can set the order shipping items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setShippingItems()
     *
     * @throws ReflectionException
     */
    public function testCanSetShippingItems()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'shippingItems');

        $this->assertEquals([], $property->getValue($order));

        $items = [new ShippingItem(), new ShippingItem()];
        $order->setShippingItems($items);

        $this->assertEquals($items, $property->getValue($order));
    }

    /**
     * Tests that can set the order shipping items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setShippingAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetShippingAmount()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'shippingAmount');

        $this->assertNull($property->getValue($order));

        $amount = new CurrencyAmount();
        $order->setShippingAmount($amount);

        $this->assertEquals($amount, $property->getValue($order));
    }

    /**
     * Tests that can set the order fee items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setFeeItems()
     *
     * @throws ReflectionException
     */
    public function testCanSetFeeItems()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'feeItems');

        $this->assertEquals([], $property->getValue($order));

        $items = [new FeeItem(), new FeeItem()];
        $order->setFeeItems($items);

        $this->assertEquals($items, $property->getValue($order));
    }

    /**
     * Tests that can set the order fee items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setFeeAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetFeeAmount()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'feeAmount');

        $this->assertNull($property->getValue($order));

        $amount = new CurrencyAmount();
        $order->setFeeAmount($amount);

        $this->assertEquals($amount, $property->getValue($order));
    }

    /**
     * Tests that can set the order tax items.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setTaxItems()
     *
     * @throws ReflectionException
     */
    public function testCanSetTaxItems()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'taxItems');

        $this->assertEquals([], $property->getValue($order));

        $items = [new TaxItem(), new TaxItem()];
        $order->setTaxItems($items);

        $this->assertEquals($items, $property->getValue($order));
    }

    /**
     * Tests that can set the order tax items amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setTaxAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetTaxAmount()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'taxAmount');

        $this->assertNull($property->getValue($order));

        $amount = new CurrencyAmount();
        $order->setTaxAmount($amount);

        $this->assertEquals($amount, $property->getValue($order));
    }

    /**
     * Tests that can set the order total amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Order::setTotalAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetTotalAmount()
    {
        $order = new Order();
        $property = TestHelpers::getInaccessibleProperty($order, 'totalAmount');

        $this->assertNull($property->getValue($order));

        $amount = new CurrencyAmount();
        $order->setTotalAmount($amount);

        $this->assertEquals($amount, $property->getValue($order));
    }

    /**
     * Gets a mock order status.
     *
     * @return OrderStatusContract
     */
    public function getMockOrderStatus() : OrderStatusContract
    {
        return new class implements OrderStatusContract
        {
            public function getName(): string
            {
                return 'test-status';
            }

            public function getLabel(): string
            {
                return 'Test Status';
            }

            public function setName(string $name)
            {
            }

            public function setLabel(string $label)
            {
            }
        };
    }
}
