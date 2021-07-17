<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions\Statuses;

use GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\ApprovedTransactionStatus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\ApprovedTransactionStatus
 */
class ApprovedTransactionStatusTest extends TestCase
{
    /**
     * Tests that can get the approved transaction status name.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\ApprovedTransactionStatus::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('approved', (new ApprovedTransactionStatus())->getName());
    }

    /**
     * Tests that can get the approved transaction status label.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\ApprovedTransactionStatus::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Approved', (new ApprovedTransactionStatus())->getLabel());
    }
}
