<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Events\CaptureTransactionEvent;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\CaptureTransactionEvent
 */
class CaptureTransactionEventTest extends TestCase
{
    /**
     * Tests that can set the capture transaction.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\CaptureTransactionEvent::__construct()
     * @throws ReflectionException
     */
    public function testCanSetTransaction()
    {
        $transaction = new CaptureTransaction();
        $event = new CaptureTransactionEvent($transaction);
        $property = TestHelpers::getInaccessibleProperty($event, 'transaction');

        $this->assertEquals($transaction, $property->getValue($event));
        $this->assertEquals($transaction, $event->getTransaction());
    }
}
