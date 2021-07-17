<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Events\CreatePaymentMethodEvent;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\CreatePaymentMethodEvent
 */
class CreatePaymentMethodEventTest extends TestCase
{
    /**
     * Tests that can set a payment method for the event.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\CreatePaymentMethodEvent::__construct()
     * @dataProvider providerCanSetPaymentMethod
     *
     * @param AbstractPaymentMethod $paymentMethod
     * @throws ReflectionException
     */
    public function testCanSetPaymentMethod(AbstractPaymentMethod $paymentMethod)
    {
        $event = new CreatePaymentMethodEvent($paymentMethod);
        $property = TestHelpers::getInaccessibleProperty($event, 'paymentMethod');

        $this->assertEquals($paymentMethod, $property->getValue($event));
        $this->assertEquals($paymentMethod, $event->getPaymentMethod());
    }

    /** @see testCanSetPaymentMethod */
    public function providerCanSetPaymentMethod() : array
    {
        return [
            [new CardPaymentMethod()],
            [new BankAccountPaymentMethod()],
        ];
    }
}
