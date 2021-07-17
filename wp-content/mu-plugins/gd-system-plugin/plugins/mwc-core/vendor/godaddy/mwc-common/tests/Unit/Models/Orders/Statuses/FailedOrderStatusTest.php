<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders\Statuses;

use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\FailedOrderStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\FailedOrderStatus
 */
class FailedOrderStatusTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\FailedOrderStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('failed', (new FailedOrderStatus())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\FailedOrderStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Failed', (new FailedOrderStatus())->getLabel());
    }
}
