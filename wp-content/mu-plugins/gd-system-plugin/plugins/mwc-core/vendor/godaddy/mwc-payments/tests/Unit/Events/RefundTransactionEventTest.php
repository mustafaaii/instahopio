<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Events\RefundTransactionEvent;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\RefundTransactionEvent
 */
class RefundTransactionEventTest extends TestCase
{
    /**
     * Tests that can set the refund transaction.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\RefundTransactionEvent::__construct()
     * @throws ReflectionException
     */
    public function testCanSetTransaction()
    {
        $transaction = new RefundTransaction();
        $event = new RefundTransactionEvent($transaction);
        $property = TestHelpers::getInaccessibleProperty($event, 'transaction');

        $this->assertEquals($transaction, $property->getValue($event));
        $this->assertEquals($transaction, $event->getTransaction());
    }
}
