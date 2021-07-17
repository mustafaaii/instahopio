<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Events\PaymentTransactionEvent;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\PaymentTransactionEvent
 */
class PaymentTransactionEventTest extends TestCase
{
    /**
     * Tests that can set the payment transaction.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\PaymentTransactionEvent::__construct()
     * @throws ReflectionException
     */
    public function testCanSetTransaction()
    {
        $transaction = new PaymentTransaction();
        $event = new PaymentTransactionEvent($transaction);
        $property = TestHelpers::getInaccessibleProperty($event, 'transaction');

        $this->assertEquals($transaction, $property->getValue($event));
        $this->assertEquals($transaction, $event->getTransaction());
    }
}
