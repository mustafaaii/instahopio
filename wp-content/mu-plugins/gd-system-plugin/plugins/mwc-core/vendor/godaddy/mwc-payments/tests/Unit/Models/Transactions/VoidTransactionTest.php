<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions;

use GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction
 */
class VoidTransactionTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction
     *
     * @NOTE this is a placeholder in case we add more tests to this class {FN 2021-04-09}
     */
    public function testIsChildInstance()
    {
        $this->assertInstanceOf(RefundTransaction::class, new VoidTransaction());
    }
}
