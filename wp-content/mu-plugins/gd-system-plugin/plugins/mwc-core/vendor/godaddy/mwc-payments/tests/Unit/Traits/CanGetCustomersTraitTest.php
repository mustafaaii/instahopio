<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Http\Response;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Traits\CanGetCustomersTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanGetCustomersTrait
 */
class CanGetCustomersTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanGetCustomersTrait::get()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanDoGetRequest()
    {
        $customer = $this->getTraitMock(['foo' => 'bar'], ['id' => '123'])->get(['foo' => 'bar']);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals(123, $customer->getId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanGetCustomersTrait::getAll()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanDoGetAllRequest()
    {
        $customer = $this->getTraitMock(['foo' => 'bar'], [['id' => '123'], ['id' => '456']])->getAll(['foo' => 'bar']);

        $this->assertIsArray($customer);
        $this->assertCount(2, $customer);
        $this->assertEquals(456, $customer[1]->getId());
    }

    /**
     * @param array $params
     * @param array $response
     *
     * @return CanGetCustomersTrait|MockObject
     * @throws ReflectionException
     */
    private function getTraitMock(array $params, array $response)
    {
        $mock = $this->getMockForTrait(
            CanGetCustomersTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doRequest']
        );

        $mock->method('doRequest')
            ->with('GET', $params)
            ->willReturn((new Response())->body($response));

        $customerAdapterMock = $this->getCustomerAdapterMock($response);

        TestHelpers::getInaccessibleProperty(get_class($mock), 'customerAdapter')->setValue($mock, get_class($customerAdapterMock));

        return $mock;
    }

    /**
     * @param array $body
     *
     * @return object
     */
    private function getCustomerAdapterMock(array $body)
    {
        return new class($body) {

            protected $source;

            public function __construct($body)
            {
                $this->source = $body;
            }

            public function convertFromSource() : Customer
            {
                $customer = new Customer();
                $customer->setId($this->source['id']);

                return $customer;
            }
        };
    }
}
