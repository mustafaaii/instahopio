<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpers;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanDeletePaymentMethodsTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanDeletePaymentMethodsTrait
 */
class CanDeletePaymentMethodsTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanDeletePaymentMethodsTrait::delete()
     * @throws ReflectionException
     */
    public function testCanDelete()
    {
        $mock = $this->getMockForTrait(
            CanDeletePaymentMethodsTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $adapterClass = get_class(TestHelpers::getDataSourceAdapterContractMock());

        CommonTestHelpers::getInaccessibleProperty(get_class($mock), 'paymentMethodAdapter')->setValue($mock, $adapterClass);

        $paymentMethod = $this->getMockForAbstractClass(AbstractPaymentMethod::class);

        $mock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($paymentMethod, $this->isInstanceOf($adapterClass))
            ->willReturn($paymentMethod);

        $this->assertInstanceOf(AbstractPaymentMethod::class, $mock->delete($paymentMethod));
    }
}
