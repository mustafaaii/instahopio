<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Payments\Events\AbstractTransactionEvent;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\AbstractTransactionEvent
 */
class AbstractTransactionEventTest extends TestCase
{
    /**
     * Tests that can get the transaction.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\AbstractTransactionEvent::getTransaction()
     * @dataProvider providerGetTransaction
     *
     * @param AbstractTransaction $transaction
     */
    public function testCanGetTransaction(AbstractTransaction $transaction)
    {
        $instance = $this->getInstance($transaction);

        $this->assertEquals($transaction, $instance->getTransaction());
    }

    /** @see testCanGetTransaction */
    public function providerGetTransaction() : array
    {
        return [
            [new CaptureTransaction()],
            [new PaymentTransaction()],
            [new RefundTransaction()],
            [new VoidTransaction()],
        ];
    }

    /**
     * Gets an instance of an object implementing the abstract.
     *
     * @param AbstractTransaction $transaction
     * @return AbstractTransactionEvent
     */
    private function getInstance(AbstractTransaction $transaction) : AbstractTransactionEvent
    {
        return new class($transaction) extends AbstractTransactionEvent
        {
            public function __construct(AbstractTransaction $transaction)
            {
                $this->transaction = $transaction;
            }
        };
    }
}
