<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models\Orders\Statuses;

use GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\HeldOrderStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\HeldOrderStatus
 */
class HeldOrderStatusTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\HeldOrderStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('held', (new HeldOrderStatus())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Orders\Statuses\HeldOrderStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Held', (new HeldOrderStatus())->getLabel());
    }
}
