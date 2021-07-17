<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpersAlias;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanUpdateCustomersTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanUpdateCustomersTrait
 */
class CanUpdateCustomersTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanUpdateCustomersTrait::update()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanUpdate()
    {
        $mock = $this->getMockForTrait(
            CanUpdateCustomersTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $dataSourceAdapterContractClassName = get_class(TestHelpers::getDataSourceAdapterContractMock());

        CommonTestHelpersAlias::getInaccessibleProperty(get_class($mock), 'customerAdapter')->setValue($mock, $dataSourceAdapterContractClassName);

        $customer = new Customer();
        $customer->setId(123);

        $mock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($customer, $this->isInstanceOf($dataSourceAdapterContractClassName))
            ->willReturn($customer);

        $this->assertEquals($customer, $mock->update($customer));
    }
}
