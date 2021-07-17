<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\HasCustomersTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\HasCustomersTrait
 */
class HasCustomersTraitTest extends TestCase
{
    /**
     * Tests that can get the customers gateway instance.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\HasCustomersTrait::customers()
     */
    public function testCanGetCustomersInstance()
    {
        $gatewayMock = TestHelpers::getMockGateway();
        $traitMock = $this->getMockCustomerTrait(get_class($gatewayMock));

        $this->assertInstanceOf(get_class($gatewayMock), $traitMock->customers());
    }

    /**
     * Gets a class instance implementing the trait.
     *
     * @param string $customersGateway
     * @return object|HasCustomersTrait
     */
    private function getMockCustomerTrait(string $customersGateway)
    {
        return new class ($customersGateway) {
            use HasCustomersTrait;

            public function __construct($customersGateway)
            {
                $this->customersGateway = $customersGateway;
            }
        };
    }
}
