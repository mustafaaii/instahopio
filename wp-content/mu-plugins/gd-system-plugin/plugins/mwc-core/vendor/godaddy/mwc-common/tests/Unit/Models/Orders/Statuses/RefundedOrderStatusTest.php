<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders\Statuses;

use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\RefundedOrderStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\RefundedOrderStatus
 */
class RefundedOrderStatusTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\RefundedOrderStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('refunded', (new RefundedOrderStatus())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\RefundedOrderStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Refunded', (new RefundedOrderStatus())->getLabel());
    }
}
