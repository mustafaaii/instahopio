<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions\Statuses;

use GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\DeclinedTransactionStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\DeclinedTransactionStatus
 */
class DeclinedTransactionStatusTest extends TestCase
{
    /**
     * Tests that can get the declined transaction status name.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\DeclinedTransactionStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('declined', (new DeclinedTransactionStatus())->getName());
    }

    /**
     * Tests that can get the declined transaction status label.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\DeclinedTransactionStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Declined', (new DeclinedTransactionStatus())->getLabel());
    }
}
