<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Events\Events;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Traits\CanCreatePaymentMethodsTrait;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanCreatePaymentMethodsTrait
 */
class CanCreatePaymentMethodsTraitTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanCreatePaymentMethodsTrait::create()
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanCreate()
    {
        $mock = $this->getMockForTrait(
            CanCreatePaymentMethodsTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $adapterClass = get_class($this->getDataSourceAdapterContractMock());

        TestHelpers::getInaccessibleProperty(get_class($mock), 'paymentMethodAdapter')->setValue($mock, $adapterClass);

        $paymentMethod = $this->getMockForAbstractClass(AbstractPaymentMethod::class);

        $mock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($paymentMethod, $this->isInstanceOf($adapterClass))
            ->willReturn($paymentMethod);
        $this->mockStaticMethod(Events::class, 'broadcast')->withAnyArgs()->once();

        $this->assertInstanceOf(AbstractPaymentMethod::class, $mock->create($paymentMethod));
    }

    private function getDataSourceAdapterContractMock() : DataSourceAdapterContract
    {
        return new class implements DataSourceAdapterContract {

            public function convertFromSource() : array
            {
                return [];
            }

            public function convertToSource() : array
            {
                return [];
            }
        };
    }
}
