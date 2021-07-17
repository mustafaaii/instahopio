<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions;

use GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction
 */
class CaptureTransactionTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction
     *
     * @NOTE this is a placeholder in case we add more tests to this class {FN 2021-04-09}
     */
    public function testIsAbstractInstance()
    {
        $this->assertInstanceOf(AbstractTransaction::class, new CaptureTransaction());
    }
}
