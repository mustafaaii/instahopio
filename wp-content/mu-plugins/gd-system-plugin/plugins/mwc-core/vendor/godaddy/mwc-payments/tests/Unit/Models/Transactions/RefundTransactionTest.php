<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction
 */
class RefundTransactionTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction::getReason()
     */
    public function testCanGetReason()
    {
        $refund = new RefundTransaction();

        $this->assertNull($refund->getReason());

        $refund->setReason('Test Reason');

        $this->assertEquals('Test Reason', $refund->getReason());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction::setReason()
     *
     * @throws ReflectionException
     */
    public function testCanSetReason()
    {
        $refund = new RefundTransaction();
        $property = TestHelpers::getInaccessibleProperty($refund, 'reason');

        $this->assertNull($property->getValue($refund));

        $refund->setReason('Test Reason');

        $this->assertEquals('Test Reason', $property->getValue($refund));
    }
}
