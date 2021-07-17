<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Models\Address;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\BillableTrait;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\BillableTrait
 */
final class BillableTraitTest extends TestCase
{
    /**
     * Tests that can get the billing address.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\BillableTrait::getBillingAddress()
     */
    public function testCanGetBillingAddress()
    {
        $trait = $this->getMockInstance();

        $trait->setBillingAddress($this->getMockAddress());

        $this->assertEquals('GoDaddy', $trait->getBillingAddress()->getBusinessName());
    }

    /**
     * Tests that can set the billing address.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\BillableTrait::setBillingAddress()
     * @throws ReflectionException
     */
    public function testCanSetBillingAddress()
    {
        $trait = $this->getMockInstance();

        $property = TestHelpers::getInaccessibleProperty(get_class($trait), 'billingAddress');

        $trait->setBillingAddress($this->getMockAddress());

        $this->assertEquals('Jon', $property->getValue($trait)->getFirstName());
    }

    /**
     * Gets a mock instance implementing the trait.
     *
     * @return object|BillableTrait
     */
    private function getMockInstance()
    {
        return new class() {
            use BillableTrait;
        };
    }

    /**
     * Gets a mock Address instance
     *
     * @return Address
     */
    private function getMockAddress()
    {
        return (new Address())
            ->setFirstname('Jon')
            ->setLastName('Snow')
            ->setBusinessName('GoDaddy');
    }
}
