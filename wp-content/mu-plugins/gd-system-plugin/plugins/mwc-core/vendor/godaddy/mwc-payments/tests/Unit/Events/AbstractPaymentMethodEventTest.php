<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Payments\Events\AbstractPaymentMethodEvent;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\AbstractPaymentMethodEvent
 */
class AbstractPaymentMethodEventTest extends TestCase
{
    /**
     * Tests that can get the payment method.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\AbstractPaymentMethodEvent::getPaymentMethod()
     * @dataProvider providerGetPaymentMethod
     *
     * @param AbstractPaymentMethod $paymentMethod
     */
    public function testCanGetPaymentMethod(AbstractPaymentMethod $paymentMethod)
    {
        $instance = $this->getInstance($paymentMethod);

        $this->assertEquals($paymentMethod, $instance->getPaymentMethod());
    }

    /** @see testCanGetPaymentMethod */
    public function providerGetPaymentMethod() : array
    {
        return [
            [new CardPaymentMethod()],
            [new BankAccountPaymentMethod()],
        ];
    }

    /**
     * Gets an instance of an object implementing the abstract.
     *
     * @param AbstractPaymentMethod $paymentMethod
     * @return AbstractPaymentMethodEvent
     */
    private function getInstance(AbstractPaymentMethod $paymentMethod) : AbstractPaymentMethodEvent
    {
        return new class($paymentMethod) extends AbstractPaymentMethodEvent
        {
            public function __construct(AbstractPaymentMethod $paymentMethod)
            {
                $this->paymentMethod = $paymentMethod;
            }
        };
    }
}
