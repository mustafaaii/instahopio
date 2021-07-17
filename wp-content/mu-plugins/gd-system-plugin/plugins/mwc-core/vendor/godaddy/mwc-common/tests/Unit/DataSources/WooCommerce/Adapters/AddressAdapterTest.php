<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\DataSources\WooCommerce\Adapters;

use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\AddressAdapter;
use GoDaddy\WordPress\MWC\Common\Models\Address;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\AddressAdapter
 */
final class AddressAdapterTest extends TestCase
{
    /**
     * Tests that can initialize adapter.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\AddressAdapter::__construct()
     *
     * @throws ReflectionException
     */
    public function testCanAssignSource()
    {
        $addressData = $this->getWooCommerceAddressData();
        $adapter = new AddressAdapter($addressData);
        $source = TestHelpers::getInaccessibleProperty($adapter, 'source');

        $this->assertEquals($addressData, $source->getValue($adapter));
    }

    /**
     * Tests that can convert an address from source to native object.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\AddressAdapter::convertFromSource()
     */
    public function testCanConvertFromSource()
    {
        $woocommerceAddress = $this->getWooCommerceAddressData();
        $adapter = new AddressAdapter($woocommerceAddress);
        $nativeAddress = $adapter->convertFromSource();

        $this->assertEquals($woocommerceAddress['company'], $nativeAddress->getBusinessName());
        $this->assertEquals($woocommerceAddress['first_name'], $nativeAddress->getFirstName());
        $this->assertEquals($woocommerceAddress['last_name'], $nativeAddress->getLastName());
        $this->assertEquals($woocommerceAddress['address_1'], $nativeAddress->getLines()[0] ?? '');
        $this->assertEquals($woocommerceAddress['address_2'], $nativeAddress->getLines()[1] ?? '');
        $this->assertEquals($woocommerceAddress['city'], $nativeAddress->getLocality());
        $this->assertEquals($woocommerceAddress['state'], current($nativeAddress->getAdministrativeDistricts()));
        $this->assertEquals($woocommerceAddress['postcode'], $nativeAddress->getPostalCode());
        $this->assertEquals($woocommerceAddress['country'], $nativeAddress->getCountryCode());
    }

    /**
     * Tests that can convert an address from native object to source array.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\AddressAdapter::convertFromSource()
     */
    public function testCanConvertToSource()
    {
        $adapter = new AddressAdapter([]);
        $nativeAddress = (new Address())->setProperties($this->getNativeAddressData());
        $woocommerceAddress = $adapter->convertToSource($nativeAddress);

        $this->assertIsArray($woocommerceAddress);
        $this->assertNotEmpty($woocommerceAddress);
        $this->assertArrayHasKey('address_1', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['address_1'], $nativeAddress->getLines()[0]);
        $this->assertArrayHasKey('address_2', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['address_2'], $nativeAddress->getLines()[1]);
        $this->assertArrayHasKey('company', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['company'], $nativeAddress->getBusinessName());
        $this->assertArrayHasKey('first_name', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['first_name'], $nativeAddress->getFirstName());
        $this->assertArrayHasKey('last_name', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['last_name'], $nativeAddress->getLastName());
        $this->assertArrayHasKey('country', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['country'], $nativeAddress->getCountryCode());
        $this->assertArrayHasKey('postcode', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['postcode'], $nativeAddress->getPostalCode());
        $this->assertArrayHasKey('state', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['state'], current($nativeAddress->getAdministrativeDistricts()));
        $this->assertArrayHasKey('city', $woocommerceAddress);
        $this->assertEquals($woocommerceAddress['city'], $nativeAddress->getLocality());
    }

    /** @see AddressAdapterTest tests */
    private function getWooCommerceAddressData() : array
    {
        return [
            'company'    => 'SkyVerge',
            'first_name' => 'Barb',
            'last_name'  => 'DeBear',
            'address_1'  => '177 Huntington Ave',
            'address_2'  => 'Ste 1703 #70640',
            'city'       => 'Boston',
            'state'      => 'MA',
            'postcode'   => '02115-3153',
            'country'    => 'US'
        ];
    }

    /** @see AddressAdapterTest tests */
    private function getNativeAddressData() : array
    {
        return [
            'businessName'            => 'SkyVerge',
            'firstName'               => 'Barb',
            'lastName'                => 'DeBear',
            'lines'                   => ['177 Huntington Ave', 'Ste 1703 #70640'],
            'locality'                => 'Boston',
            'administrativeDistricts' => ['MA'],
            'postalCode'              => '02115-3153',
            'countryCode'             => 'US',
        ];
    }
}
