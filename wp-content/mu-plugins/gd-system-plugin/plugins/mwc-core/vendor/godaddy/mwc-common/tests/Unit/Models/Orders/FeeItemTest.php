<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders;

use GoDaddy\WordPress\MWC\Common\Models\Orders\FeeItem;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\FeeItem
 */
final class FeeItemTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\FeeItem::setTaxAmount()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\FeeItem::getTaxAmount()
     */
    public function testCanSetGetFeeItemTaxAmount()
    {
        $item = new FeeItem();

        $amount = new CurrencyAmount();
        $amount->setAmount(25);
        $amount->setCurrencyCode('EGP');

        $item->setTaxAmount($amount);

        $this->assertSame($amount->getAmount(), $item->getTaxAmount()->getAmount());
        $this->assertSame($amount->getCurrencyCode(), $item->getTaxAmount()->getCurrencyCode());
    }
}
