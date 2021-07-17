<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Events\VoidTransactionEvent;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\VoidTransactionEvent
 */
class VoidTransactionEventTest extends TestCase
{
    /**
     * Tests that can set the void transaction.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\VoidTransactionEvent::__construct()
     * @throws ReflectionException
     */
    public function testCanSetTransaction()
    {
        $transaction = new VoidTransaction();
        $event = new VoidTransactionEvent($transaction);
        $property = TestHelpers::getInaccessibleProperty($event, 'transaction');

        $this->assertEquals($transaction, $property->getValue($event));
        $this->assertEquals($transaction, $event->getTransaction());
    }
}
