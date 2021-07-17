<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\ShippableTrait;
use GoDaddy\WordPress\MWC\Common\Models\Address;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\ShippableTrait
 */
final class ShippableTraitTest extends TestCase
{
    /**
     * Tests that can get the billing address.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\ShippableTrait::getShippingAddress()
     */
    public function testCanGetShippingAddress()
    {
        $trait = $this->getMockInstance();

        $trait->setShippingAddress($this->getMockAddress());

        $this->assertEquals('GoDaddy', $trait->getShippingAddress()->getBusinessName());
    }

    /**
     * Tests that can set the billing address.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\ShippableTrait::setShippingAddress()
     * @throws ReflectionException
     */
    public function testCanSetShippingAddress()
    {
        $trait = $this->getMockInstance();

        $property = TestHelpers::getInaccessibleProperty(get_class($trait), 'shippingAddress');

        $trait->setShippingAddress($this->getMockAddress());

        $this->assertEquals('Jon', $property->getValue($trait)->getFirstName());
    }

    /**
     * Gets a mock instance implementing the trait.
     *
     * @return object
     */
    private function getMockInstance()
    {
        return new class() {
            use ShippableTrait;
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
