<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpers;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\HasPaymentMethodsTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\HasPaymentMethodsTrait
 */
class HasPaymentMethodsTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\HasPaymentMethodsTrait::paymentMethods()
     * @throws \ReflectionException
     */
    public function testCanGetCustomersInstance()
    {
        $gatewayMockClass = get_class(TestHelpers::getMockGateway());

        $traitMock = $this->getMockForTrait(HasPaymentMethodsTrait::class);

        CommonTestHelpers::getInaccessibleProperty(get_class($traitMock), 'paymentMethodsGateway')->setValue($traitMock, $gatewayMockClass);

        $this->assertInstanceOf($gatewayMockClass, $traitMock->paymentMethods());
    }
}
