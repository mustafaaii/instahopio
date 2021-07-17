<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders;

use GoDaddy\WordPress\MWC\Common\Models\Orders\AbstractOrderItem;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\AbstractOrderItem
 */
final class AbstractOrderItemTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\AbstractOrderItem::setId()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\AbstractOrderItem::getId()
     */
    public function testCanSetGetOrderItemId()
    {
        $item = $this->getInstance();

        $itemId = 123;

        $item->setId($itemId);

        $this->assertSame($itemId, $item->getId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\AbstractOrderItem::setTotalAmount()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\AbstractOrderItem::setTotalAmount()
     */
    public function testCanSetGetOrderItemTotalAmount()
    {
        $item = $this->getInstance();

        $amount = new CurrencyAmount();
        $amount->setAmount(2000);
        $amount->setCurrencyCode('USD');

        $item->setTotalAmount($amount);

        $this->assertSame($amount->getAmount(), $item->getTotalAmount()->getAmount());
        $this->assertSame($amount->getCurrencyCode(), $item->getTotalAmount()->getCurrencyCode());
    }

    /**
     * @return AbstractOrderItem
     */
    private function getInstance() : AbstractOrderItem
    {
        return new class extends AbstractOrderItem {
        };
    }
}
