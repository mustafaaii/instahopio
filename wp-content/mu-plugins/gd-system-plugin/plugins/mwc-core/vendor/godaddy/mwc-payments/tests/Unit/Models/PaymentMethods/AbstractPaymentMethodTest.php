<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods;

use DateTime;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod
 */
class AbstractPaymentMethodTest extends TestCase
{
    /**
     * @var AbstractPaymentMethod|MockObject
     */
    protected $abstractPaymentMethodMock;

    protected function setUp() : void
    {
        $this->abstractPaymentMethodMock = $this->getMockForAbstractClass(AbstractPaymentMethod::class);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::getCreatedAt()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::setCreatedAt()
     */
    public function testCanGetAndSetCreatedAt()
    {
        $this->assertNull($this->abstractPaymentMethodMock->getCreatedAt());

        $datetime = new DateTime('2021-04-01T15:03:01.012345Z');

        $this->abstractPaymentMethodMock->setCreatedAt($datetime);

        $this->assertEquals($datetime, $this->abstractPaymentMethodMock->getCreatedAt());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::getCustomerId()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::setCustomerId()
     */
    public function testCanGetAndSetCustomerId()
    {
        $this->assertNull($this->abstractPaymentMethodMock->getCustomerId());

        $customerId = 'ABC123';

        $this->abstractPaymentMethodMock->setCustomerId($customerId);

        $this->assertEquals($customerId, $this->abstractPaymentMethodMock->getCustomerId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::getId()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::setId()
     */
    public function testCanGetAndSetId()
    {
        $this->assertNull($this->abstractPaymentMethodMock->getId());

        $id = 123;

        $this->abstractPaymentMethodMock->setId($id);

        $this->assertEquals($id, $this->abstractPaymentMethodMock->getId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::getRemoteId()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::setRemoteId()
     */
    public function testCanGetAndSetRemoteId()
    {
        $this->assertNull($this->abstractPaymentMethodMock->getRemoteId());

        $remoteId = 'ABC123';

        $this->abstractPaymentMethodMock->setRemoteId($remoteId);

        $this->assertEquals($remoteId, $this->abstractPaymentMethodMock->getRemoteId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::getUpdatedAt()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::setUpdatedAt()
     */
    public function testCanGetAndSetUpdatedAt()
    {
        $this->assertNull($this->abstractPaymentMethodMock->getUpdatedAt());

        $datetime = new DateTime('2021-04-01T15:03:01.012345Z');

        $this->abstractPaymentMethodMock->setUpdatedAt($datetime);

        $this->assertEquals($datetime, $this->abstractPaymentMethodMock->getUpdatedAt());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::getLabel()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod::setLabel()
     */
    public function testCanGetAndSetLabel()
    {
        $this->assertNull($this->abstractPaymentMethodMock->getLabel());

        $label = 'Poynt';

        $this->abstractPaymentMethodMock->setLabel($label);

        $this->assertEquals($label, $this->abstractPaymentMethodMock->getLabel());
    }
}
