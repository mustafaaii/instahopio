<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Contracts;

use GoDaddy\WordPress\MWC\Common\Contracts\FulfillmentStatusContract;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Contracts\FulfillmentStatusContract
 */
final class FulfillmentStatusContractTest extends TestCase
{
    /**
     * Dummy test to assert that the FulfillmentStatusContract can be implemented.
     */
    public function testCanImplementFulfillmentStatusContract()
    {
        $dummy_extension = new class() implements FulfillmentStatusContract {

            use HasLabelTrait;

            public function __construct()
            {
                $this->setName('name');
                $this->setLabel('label');
            }
        };

        $this->assertSame('name', $dummy_extension->getName());
        $this->assertSame('label', $dummy_extension->getLabel());
    }
}
