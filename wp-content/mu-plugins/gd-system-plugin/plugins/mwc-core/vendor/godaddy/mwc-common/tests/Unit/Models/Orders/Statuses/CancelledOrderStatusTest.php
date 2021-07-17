<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders\Statuses;

use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\CancelledOrderStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\CancelledOrderStatus
 */
class CancelledOrderStatusTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\CancelledOrderStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('cancelled', (new CancelledOrderStatus())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\CancelledOrderStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Cancelled', (new CancelledOrderStatus())->getLabel());
    }
}
