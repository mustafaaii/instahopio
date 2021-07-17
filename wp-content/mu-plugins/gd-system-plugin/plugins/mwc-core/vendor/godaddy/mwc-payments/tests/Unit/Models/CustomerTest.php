<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Users\User;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer
 */
class CustomerTest extends TestCase
{
    protected $customer;

    protected function setUp() : void
    {
        $this->customer = new Customer();
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::getId()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::setId()
     */
    public function testCanSetAndGetId()
    {
        $id = 1234;

        $this->customer->setId($id);

        $this->assertEquals($id, $this->customer->getId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::setPaymentMethods()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::getPaymentMethods()
     */
    public function testCanSetAndGetPaymentMethods()
    {
        $mock = $this->getMockForAbstractClass(AbstractPaymentMethod::class);
        $array = [$mock];

        $this->customer->setPaymentMethods($array);

        $this->assertEquals($array, $this->customer->getPaymentMethods());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::setRemoteId()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::getRemoteId()
     */
    public function testCanSetAndGetRemoteId()
    {
        $remoteId = 'ABC123';

        $this->customer->setRemoteId($remoteId);

        $this->assertEquals($remoteId, $this->customer->getRemoteId());

    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::setUser()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Customer::getUser()
     */
    public function testCanSetAndGetUser()
    {
        $user = User::seed(['email' => 'test@email.com']);

        $this->customer->setUser($user);

        $retrievedUser = $this->customer->getUser();
        $this->assertEquals('test@email.com', $retrievedUser->getEmail());
    }
}
