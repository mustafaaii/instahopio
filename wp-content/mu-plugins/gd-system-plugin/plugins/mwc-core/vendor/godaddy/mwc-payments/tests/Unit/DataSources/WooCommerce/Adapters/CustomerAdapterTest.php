<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\DataSources\WooCommerce\Adapters;

use GoDaddy\WordPress\MWC\Common\Models\Address;
use GoDaddy\WordPress\MWC\Common\Users\User;
use GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CustomerAdapter;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use Mockery;
use PHPUnit\Framework\TestCase;
use WC_Customer;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CustomerAdapter
 */
class CustomerAdapterTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CustomerAdapter::convertFromSource()
     */
    public function testCanConvertFromSource()
    {
        WP_Mock::userFunction('get_user_by')->andReturn([
            'ID' => 1,
        ]);

        $nativeCustomer = (new CustomerAdapter($this->getWooCommerceCustomerMock()))->convertFromSource();

        $this->assertInstanceOf(Customer::class, $nativeCustomer);
        $this->assertInstanceOf(User::class, $nativeCustomer->getUser());

        $this->assertSame(1, $nativeCustomer->getId());
        $this->assertSame('ABC-123', $nativeCustomer->getRemoteId());

        $billingAddress = $nativeCustomer->getBillingAddress();

        $this->assertInstanceOf(Address::class, $billingAddress);
        $this->assertSame(['MA'], $billingAddress->getAdministrativeDistricts());
        $this->assertSame('GoDaddy', $billingAddress->getBusinessName());
        $this->assertSame('US', $billingAddress->getCountryCode());
        $this->assertSame('Jonathan', $billingAddress->getFirstName());
        $this->assertSame('Doe', $billingAddress->getLastName());
        $this->assertSame(['235 Secondary st', 'Suite A'], $billingAddress->getLines());
        $this->assertSame('Boston', $billingAddress->getLocality());
        $this->assertSame('02115-3153', $billingAddress->getPostalCode());

        $shippingAddress = $nativeCustomer->getShippingAddress();

        $this->assertInstanceOf(Address::class, $shippingAddress);
        $this->assertSame(['CA'], $shippingAddress->getAdministrativeDistricts());
        $this->assertSame('SkyVerge', $shippingAddress->getBusinessName());
        $this->assertSame('US', $shippingAddress->getCountryCode());
        $this->assertSame('John', $shippingAddress->getFirstName());
        $this->assertSame('Doe', $shippingAddress->getLastName());
        $this->assertSame(['124 Main st', 'Apt 1'], $shippingAddress->getLines());
        $this->assertSame('San Fransisco', $shippingAddress->getLocality());
        $this->assertSame('90001', $shippingAddress->getPostalCode());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CustomerAdapter::convertToSource()
     */
    public function testCanConvertToSource()
    {
        $nativeCustomer = (new Customer())
            ->setId(1)
            ->setRemoteId('ABC-123')
            ->setBillingAddress((new Address)
                ->setFirstname('Billing')
                ->setLastName('Biller')
                ->setAdministrativeDistricts(['MI'])
                ->setBusinessName('ACME')
                ->setCountryCode('CA')
                ->setLines([
                    '1234 Test Street',
                    'Apt 6',
                ])
                ->setLocality('Grand Rapids')
                ->setPostalCode('12345')
            )
            ->setShippingAddress((new Address)
                ->setFirstname('Shipping')
                ->setLastName('Shipper')
                ->setAdministrativeDistricts(['AL'])
                ->setBusinessName('Tesla')
                ->setCountryCode('UK')
                ->setLines([
                    '1234 Test Ave',
                    'Apt 7',
                ])
                ->setLocality('London')
                ->setPostalCode('ABCDE')
            );

        $wooCustomer = (new CustomerAdapter($this->getWooCommerceCustomerMock()))->convertToSource($nativeCustomer);

        $this->assertInstanceOf(WC_Customer::class, $wooCustomer);
    }

    private function getWooCommerceCustomerMock() : WC_Customer
    {
        $mockCustomer = Mockery::mock('\WC_Customer');
        $mockCustomer->shouldReceive('get_id')->andReturn(1);
        $mockCustomer->shouldReceive('get_email')->andReturn('test@test.local');
        $mockCustomer->shouldReceive('get_display_name')->andReturn('John Doe');
        $mockCustomer->shouldReceive('get_first_name')->andReturn('John');
        $mockCustomer->shouldReceive('get_last_name')->andReturn('Doe');
        $mockCustomer->shouldReceive('get_username')->andReturn('JohnDoe');
        $mockCustomer->shouldReceive('get_meta')->with('mwc_remote_id')->andReturn('ABC-123');
        $mockCustomer->shouldReceive('get_shipping')->andReturn([
            'company'    => 'SkyVerge',
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'address_1'  => '124 Main st',
            'address_2'  => 'Apt 1',
            'city'       => 'San Fransisco',
            'state'      => 'CA',
            'postcode'   => '90001',
            'country'    => 'US',
        ]);
        $mockCustomer->shouldReceive('get_billing')->andReturn([
            'company'    => 'GoDaddy',
            'first_name' => 'Jonathan',
            'last_name'  => 'Doe',
            'address_1'  => '235 Secondary st',
            'address_2'  => 'Suite A',
            'city'       => 'Boston',
            'state'      => 'MA',
            'postcode'   => '02115-3153',
            'country'    => 'US',
        ]);

        $mockCustomer->shouldReceive('set_id')->withArgs([1]);
        $mockCustomer->shouldReceive('update_meta_data')->withArgs(['mwc_remote_id', 'ABC-123']);
        $mockCustomer->shouldReceive('set_shipping_company')->withArgs(['Tesla']);
        $mockCustomer->shouldReceive('set_shipping_first_name')->withArgs(['Shipping']);
        $mockCustomer->shouldReceive('set_shipping_last_name')->withArgs(['Shipper']);
        $mockCustomer->shouldReceive('set_shipping_address_1')->withArgs(['1234 Test Ave']);
        $mockCustomer->shouldReceive('set_shipping_address_2')->withArgs(['Apt 7']);
        $mockCustomer->shouldReceive('set_shipping_city')->withArgs(['London']);
        $mockCustomer->shouldReceive('set_shipping_state')->withArgs(['AL']);
        $mockCustomer->shouldReceive('set_shipping_postcode')->withArgs(['ABCDE']);
        $mockCustomer->shouldReceive('set_shipping_country')->withArgs(['UK']);
        $mockCustomer->shouldReceive('set_billing_company')->withArgs(['ACME']);
        $mockCustomer->shouldReceive('set_billing_first_name')->withArgs(['Billing']);
        $mockCustomer->shouldReceive('set_billing_last_name')->withArgs(['Biller']);
        $mockCustomer->shouldReceive('set_billing_address_1')->withArgs(['1234 Test Street']);
        $mockCustomer->shouldReceive('set_billing_address_2')->withArgs(['Apt 6']);
        $mockCustomer->shouldReceive('set_billing_city')->withArgs(['Grand Rapids']);
        $mockCustomer->shouldReceive('set_billing_state')->withArgs(['MI']);
        $mockCustomer->shouldReceive('set_billing_postcode')->withArgs(['12345']);
        $mockCustomer->shouldReceive('set_billing_country')->withArgs(['CA']);

        return $mockCustomer;
    }
}
