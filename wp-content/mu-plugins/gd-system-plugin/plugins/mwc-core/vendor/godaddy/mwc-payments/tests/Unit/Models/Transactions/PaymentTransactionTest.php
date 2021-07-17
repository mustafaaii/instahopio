<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction
 */
class PaymentTransactionTest extends TestCase
{
    /**
     * @var PaymentTransaction
     */
    protected $instance;

    protected function setUp() : void
    {
        $this->instance = new PaymentTransaction();
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setAmount()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::getAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetAmount()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'amount');

        $this->assertNull($property->getValue($this->instance));

        $value = (new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD');
        $this->instance->setAmount($value);

        $this->assertInstanceOf(CurrencyAmount::class, $this->instance->getAmount());
        $this->assertSame($value, $this->instance->getAmount());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setTipAmount()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::getTipAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetTipAmount()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'tipAmount');

        $this->assertNull($property->getValue($this->instance));

        $value = (new CurrencyAmount())->setAmount(150)->setCurrencyCode('USD');
        $this->instance->setTipAmount($value);

        $this->assertInstanceOf(CurrencyAmount::class, $this->instance->getTipAmount());
        $this->assertSame($value, $this->instance->getTipAmount());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setRefundedAmount()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::getRefundedAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetRefundAmount()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'refundedAmount');

        $this->assertNull($property->getValue($this->instance));

        $value = (new CurrencyAmount())->setAmount(20)->setCurrencyCode('USD');
        $this->instance->setRefundedAmount($value);

        $this->assertInstanceOf(CurrencyAmount::class, $this->instance->getRefundedAmount());
        $this->assertSame($value, $this->instance->getRefundedAmount());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setCapturedAmount()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::getCapturedAmount()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetCapturedAmount()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'capturedAmount');

        $this->assertNull($property->getValue($this->instance));

        $value = (new CurrencyAmount())->setAmount(120)->setCurrencyCode('USD');
        $this->instance->setCapturedAmount($value);

        $this->assertInstanceOf(CurrencyAmount::class, $this->instance->getCapturedAmount());
        $this->assertSame($value, $this->instance->getCapturedAmount());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setRemoteCaptureIds()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::getRemoteCaptureIds()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetRemoteCaptureIds()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'remoteCaptureIds');

        $this->assertIsArray($property->getValue($this->instance));
        $this->assertEmpty($this->instance->getRemoteCaptureIds());

        $value = ['abs123', '456asd'];
        $this->instance->setRemoteCaptureIds($value);

        $this->assertNotEmpty($this->instance->getRemoteCaptureIds());
        $this->assertSame($value, $this->instance->getRemoteCaptureIds());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setRemoteRefundIds()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::getRemoteRefundIds()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetRemoteRefundIds()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'remoteRefundIds');

        $this->assertIsArray($property->getValue($this->instance));
        $this->assertEmpty($this->instance->getRemoteRefundIds());

        $value = ['abs123', '456asd'];
        $this->instance->setRemoteRefundIds($value);

        $this->assertNotEmpty($this->instance->getRemoteRefundIds());
        $this->assertSame($value, $this->instance->getRemoteRefundIds());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setRemoteVoidIds()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::getRemoteVoidIds()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetRemoteVoidIds()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'remoteVoidIds');

        $this->assertIsArray($property->getValue($this->instance));
        $this->assertEmpty($this->instance->getRemoteVoidIds());

        $value = ['abs456', '789asd'];
        $this->instance->setRemoteVoidIds($value);

        $this->assertNotEmpty($this->instance->getRemoteVoidIds());
        $this->assertSame($value, $this->instance->getRemoteVoidIds());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::isAuthOnly()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction::setAuthOnly()
     *
     * @throws ReflectionException
     */
    public function testCanSetAndGetAuthOnly()
    {
        $property = TestHelpers::getInaccessibleProperty(PaymentTransaction::class, 'authOnly');

        $this->assertFalse($property->getValue($this->instance));

        $this->instance->setAuthOnly(false);
        $this->assertFalse($this->instance->isAuthOnly());

        $this->instance->setAuthOnly(true);
        $this->assertTrue($this->instance->isAuthOnly());
    }
}
