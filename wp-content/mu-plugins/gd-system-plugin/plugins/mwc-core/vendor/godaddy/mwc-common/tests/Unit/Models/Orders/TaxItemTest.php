<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders;

use GoDaddy\WordPress\MWC\Common\Models\Orders\TaxItem;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\TaxItem
 */
final class TaxItemTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\TaxItem::setRate()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\TaxItem::getRate()
     */
    public function testCanSetGetTaxItemRate()
    {
        $item = new TaxItem();

        $rate = 1.5;

        $item->setRate($rate);
        $this->assertSame($rate, $item->getRate());
    }
}
