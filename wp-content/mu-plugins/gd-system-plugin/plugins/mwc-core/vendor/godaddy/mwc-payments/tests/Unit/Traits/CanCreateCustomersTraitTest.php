<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpersAlias;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanCreateCustomersTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanCreateCustomersTrait
 */
class CanCreateCustomersTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanCreateCustomersTrait::create()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanCreate()
    {
        $mock = $this->getMockForTrait(
            CanCreateCustomersTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $adapterClass = get_class(TestHelpers::getDataSourceAdapterContractMock());

        CommonTestHelpersAlias::getInaccessibleProperty(get_class($mock), 'customerAdapter')->setValue($mock, $adapterClass);

        $customer = new Customer();
        $customer->setId(123);

        $mock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($customer, $this->isInstanceOf($adapterClass))
            ->willReturn($customer);

        $this->assertEquals($customer, $mock->create($customer));
    }
}
