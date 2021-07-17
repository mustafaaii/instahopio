<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Orders\Statuses;

use GoDaddy\WordPress\MWC\Payments\Models\Orders\Statuses\PendingOrderStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Orders\Statuses\PendingOrderStatus
 */
class PendingOrderStatusTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Orders\Statuses\PendingOrderStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('pending', (new PendingOrderStatus())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Orders\Statuses\PendingOrderStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Pending payment', (new PendingOrderStatus())->getLabel());
    }
}
