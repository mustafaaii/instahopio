<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions\Statuses;

use GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\PendingTransactionStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\PendingTransactionStatus
 */
class PendingTransactionStatusTest extends TestCase
{
    /**
     * Tests that can get the pending transaction status name.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\PendingTransactionStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('pending', (new PendingTransactionStatus())->getName());
    }

    /**
     * Tests that can get the pending transaction status label.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\PendingTransactionStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Pending', (new PendingTransactionStatus())->getLabel());
    }
}
