<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Traits\PayableTrait;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\PayableTrait
 */
final class PayableTraitTest extends TestCase
{
    /**
     * Tests that can get the payment status.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\PayableTrait::getPaymentStatus()
     */
    public function testCanGetPaymentStatus()
    {
        $trait = $this->getMockInstance();

        $trait->setPaymentStatus('my-status');

        $this->assertEquals('my-status', $trait->getPaymentStatus());
    }

    /**
     * Tests that can set the payment status.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\PayableTrait::setPaymentStatus()
     */
    public function testCanSetPaymentStatus()
    {
        $trait = $this->getMockInstance();
        $reflection = new ReflectionClass($trait);
        $property = $reflection->getProperty('paymentStatus');
        $property->setAccessible(true);

        $trait->setPaymentStatus('my-status');

        $this->assertEquals('my-status', $property->getValue($trait));
    }

    /**
     * Gets a mock instance implementing the trait.
     *
     * @return object|PayableTrait
     */
    private function getMockInstance()
    {
        return new class() {
            use PayableTrait;
        };
    }
}
