<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions\Statuses;

use GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\HeldTransactionStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\HeldTransactionStatus
 */
class HeldTransactionStatusTest extends TestCase
{
    /**
     * Tests that can get the held transaction status name.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\HeldTransactionStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('held', (new HeldTransactionStatus())->getName());
    }

    /**
     * Tests that can get the held transaction status label.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\HeldTransactionStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Held', (new HeldTransactionStatus())->getLabel());
    }
}
