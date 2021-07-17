<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Models\Address;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Address
 */
final class AddressTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getAdministrativeDistricts()
     */
    public function testCanGetAdministrativeDistricts()
    {
        $address = new Address();

        $this->assertEquals([], $address->getAdministrativeDistricts());

        $address->setAdministrativeDistricts(['administrative-district']);

        $this->assertEquals(['administrative-district'], $address->getAdministrativeDistricts());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getBusinessName()
     */
    public function testCanGetBusinessName()
    {
        $address = new Address();

        $this->assertEquals('', $address->getBusinessName());

        $address->setBusinessName('SkyVerge');

        $this->assertEquals('SkyVerge', $address->getBusinessName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getCountryCode()
     */
    public function testCanGetCountryCode()
    {
        $address = new Address();

        $this->assertEquals('', $address->getCountryCode());

        $address->setCountryCode('US');

        $this->assertEquals('US', $address->getCountryCode());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getFirstName()
     */
    public function testCanGetFirstName()
    {
        $address = new Address();

        $this->assertEquals('', $address->getFirstName());

        $address->setFirstname('Barb');

        $this->assertEquals('Barb', $address->getFirstName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getLastName()
     */
    public function testCanGetLastName()
    {
        $address = new Address();

        $this->assertEquals('', $address->getLastName());

        $address->setLastName('DeBear');

        $this->assertEquals('DeBear', $address->getLastName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getLines()
     */
    public function testCanGetLines()
    {
        $address = new Address();

        $this->assertEquals([], $address->getLines());

        $address->setLines(['address-line']);

        $this->assertEquals(['address-line'], $address->getLines());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getLocality()
     */
    public function testCanGetLocality()
    {
        $address = new Address();

        $this->assertEquals('', $address->getLocality());

        $address->setLocality('Lake Tahoe');

        $this->assertEquals('Lake Tahoe', $address->getLocality());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getPostalCode()
     */
    public function testCanGetPostalCode()
    {
        $address = new Address();

        $this->assertEquals('', $address->getPostalCode());

        $address->setPostalCode('80136');

        $this->assertEquals('80136', $address->getPostalCode());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::getSubLocalities()
     */
    public function testCanGetSubLocalities()
    {
        $address = new Address();

        $this->assertEquals([], $address->getSubLocalities());

        $address->setSubLocalities(['sub-locality']);

        $this->assertEquals(['sub-locality'], $address->getSubLocalities());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setAdministrativeDistricts()
     */
    public function testCanSetAdministrativeDistricts()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('administrativeDistricts');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setAdministrativeDistricts(['test']));
        $this->assertEquals(['test'], $property->getValue($address));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setBusinessName()
     */
    public function testCanSetBusinessName()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('businessName');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setBusinessName('SkyVerge'));
        $this->assertEquals('SkyVerge', $property->getValue($address));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setCountryCode()
     */
    public function testCanSetCountryCode()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('countryCode');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setCountryCode('USA'));
        $this->assertEquals('USA', $property->getValue($address));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setFirstname()
     */
    public function testCanSetFirstName()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('firstName');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setFirstname('Barb'));
        $this->assertEquals('Barb', $property->getValue($address));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setLastName()
     */
    public function testCanSetLastName()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('lastName');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setLastName('DeBear'));
        $this->assertEquals('DeBear', $property->getValue($address));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setLines()
     */
    public function testCanSetLines()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('lines');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setLines(['test']));
        $this->assertEquals(['test'], $property->getValue($address));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setLocality()
     */
    public function testCanSetLocality()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('locality');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setLocality('Lake Tahoe'));
        $this->assertEquals('Lake Tahoe', $property->getValue($address));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setPostalCode()
     */
    public function testCanSetPostalCode()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('postalCode');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setPostalCode('80136'));
        $this->assertEquals('80136', $property->getValue($address));

    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Address::setSubLocalities()
     */
    public function testCanSetSubLocalities()
    {
        $address = new Address();
        $reflection = new ReflectionClass($address);
        $property = $reflection->getProperty('subLocalities');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($address));
        $this->assertInstanceOf(Address::class, $address->setSubLocalities(['test']));
        $this->assertEquals(['test'], $property->getValue($address));
    }
}
