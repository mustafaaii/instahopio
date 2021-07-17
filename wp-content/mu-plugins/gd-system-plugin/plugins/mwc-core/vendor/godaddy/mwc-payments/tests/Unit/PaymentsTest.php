<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit;

use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Payments;
use GoDaddy\WordPress\MWC\Payments\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use Exception;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Payments
 */
class PaymentsTest extends WPTestCase
{
    /** @var Payments */
    protected $paymentsInstance;

    public function setUp() : void
    {
        parent::setUp();

        $this->paymentsInstance = new Payments();
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Payments::__construct
     * @covers \GoDaddy\WordPress\MWC\Payments\Payments::setProviders
     * @throws Exception
     */
    public function testConstructor()
    {
        Configuration::set('payments.providers', [get_class($this->getPoyntProvider())]);

        $payment = new Payments();

        $this->assertCount(1, $payment->getProviders());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Payments::setProviders
     * @throws ReflectionException
     */
    public function testCanSetProviders()
    {
        $poyntProviderClass = get_class($this->getPoyntProvider());
        $payPalProviderClass = get_class($this->getPayPalProvider());

        $method = TestHelpers::getInaccessibleMethod(Payments::class, 'setProviders');
        $method->invoke($this->paymentsInstance, [
            $poyntProviderClass,
            $payPalProviderClass,
        ]);

        $providers = $this->paymentsInstance->getProviders();
        $this->assertCount(2, $providers);

        $this->assertEquals($this->getPoyntProvider(), $providers['poynt']);
        $this->assertEquals($this->getPayPalProvider(), $providers['paypal']);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Payments::getProviders
     * @throws ReflectionException
     */
    public function testCanGetProvider()
    {
        $providers = [$this->getMockForAbstractClass(AbstractProvider::class)];
        TestHelpers::setInaccessibleProperty($this->paymentsInstance, Payments::class, 'providers', $providers);

        $this->assertEquals($providers, $this->paymentsInstance->getProviders());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Payments::provider
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanProvider()
    {
        $providers = ['paypal' => $this->getMockForAbstractClass(AbstractProvider::class)];
        TestHelpers::setInaccessibleProperty($this->paymentsInstance, Payments::class, 'providers', $providers);

        $this->assertEquals($providers['paypal'], $this->paymentsInstance->provider('paypal'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The given provider test is not found.');

        $this->paymentsInstance->provider('test');
    }

    /**
     * Gets a mock provider for Poynt.
     *
     * @return AbstractProvider
     */
    private function getPoyntProvider() : AbstractProvider {
        return new class() extends AbstractProvider
        {
            public function __construct()
            {
                $this->name = 'poynt';
                $this->label = 'Poynt';
                $this->description = 'GoDaddy Payment Gateway Provider';
            }
        };
    }

    /**
     * Gets a mock provider for PayPal.
     *
     * @return AbstractProvider
     */
    private function getPayPalProvider() : AbstractProvider {
        return new class() extends AbstractProvider
        {
            public function __construct()
            {
                $this->name = 'paypal';
                $this->label = 'PayPal';
                $this->description = 'PayPal Payment Gateway Provider';
            }
        };
    }
}
