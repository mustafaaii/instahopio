<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpersAlias;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanDeleteCustomersTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanDeleteCustomersTrait
 */
class CanDeleteCustomersTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanDeleteCustomersTrait::delete()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanDelete()
    {
        $mock = $this->getMockForTrait(
            CanDeleteCustomersTrait::class,
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

        $this->assertEquals($customer, $mock->delete($customer));
    }
}
