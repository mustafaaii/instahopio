<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\Transactions;

use DateTime;
use GoDaddy\WordPress\MWC\Payments\Contracts\TransactionStatusContract;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction
 */
class AbstractTransactionTest extends TestCase
{

    /**
     * @var AbstractTransaction|MockObject
     */
    protected $abstractTransactionMock;

    public function setUp() : void
    {
        $this->abstractTransactionMock = $this->getMockForAbstractClass(AbstractTransaction::class);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getCreatedAt()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setCreatedAt()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetCreatedAt()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'createdAt');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $datetime = new DateTime('2021-04-01T15:03:01.012345Z');

        $this->abstractTransactionMock->setCreatedAt($datetime);

        $this->assertInstanceOf(DateTime::class, $this->abstractTransactionMock->getCreatedAt());
        $this->assertSame($datetime, $this->abstractTransactionMock->getCreatedAt());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getCustomer()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setCustomer()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetCustomer()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'customer');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $customer = new Customer;

        $this->abstractTransactionMock->setCustomer($customer);

        $this->assertInstanceOf(Customer::class, $this->abstractTransactionMock->getCustomer());
        $this->assertSame($customer, $this->abstractTransactionMock->getCustomer());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getNotes()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setNotes()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetNotes()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'notes');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $note = 'TEST NOTE';

        $this->abstractTransactionMock->setNotes($note);

        $this->assertSame($note, $this->abstractTransactionMock->getNotes());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getOrder()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setOrder()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetOrder()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'order');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $order = new Order;

        $this->abstractTransactionMock->setOrder($order);

        $this->assertInstanceOf(Order::class, $this->abstractTransactionMock->getOrder());
        $this->assertSame($order, $this->abstractTransactionMock->getOrder());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setPaymentMethod()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getPaymentMethod()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetPaymentMethod()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'paymentMethod');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $payment_method = $this->getMockForAbstractClass(AbstractPaymentMethod::class);

        $this->abstractTransactionMock->setPaymentMethod($payment_method);

        $this->assertInstanceOf(AbstractPaymentMethod::class, $this->abstractTransactionMock->getPaymentMethod());
        $this->assertSame($payment_method, $this->abstractTransactionMock->getPaymentMethod());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getUpdatedAt()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setUpdatedAt()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetUpdatedAt()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'updatedAt');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $datetime = new DateTime('2021-04-01T15:03:01.012345Z');

        $this->abstractTransactionMock->setUpdatedAt($datetime);

        $this->assertInstanceOf(DateTime::class, $this->abstractTransactionMock->getUpdatedAt());
        $this->assertSame($datetime, $this->abstractTransactionMock->getUpdatedAt());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getRemoteId()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setRemoteId()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetRemoteId()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'remoteId');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $remoteId = 'ABC123';

        $this->abstractTransactionMock->setRemoteId($remoteId);

        $this->assertSame($remoteId, $this->abstractTransactionMock->getRemoteId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getRemoteParentId()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setRemoteParentId()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetRemoteParentId()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'remoteParentId');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $remoteParentId = 'PARENT123';

        $this->abstractTransactionMock->setRemoteParentId($remoteParentId);

        $this->assertSame($remoteParentId, $this->abstractTransactionMock->getRemoteParentId());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getResultCode()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setResultCode()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetResultCode()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'resultCode');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $resultCode = 'SUCCESS';

        $this->abstractTransactionMock->setResultCode($resultCode);

        $this->assertSame($resultCode, $this->abstractTransactionMock->getResultCode());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getResultMessage()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setResultMessage()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetResultMessage()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'resultMessage');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $resultMessage = 'Success Message';

        $this->abstractTransactionMock->setResultMessage($resultMessage);

        $this->assertSame($resultMessage, $this->abstractTransactionMock->getResultMessage());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getSource()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setSource()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetSource()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'source');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $source = 'Source String';

        $this->abstractTransactionMock->setSource($source);

        $this->assertSame($source, $this->abstractTransactionMock->getSource());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setStatus()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getStatus()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetStatus()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'status');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $status = $this->mockTransactionStatusContract();

        $this->abstractTransactionMock->setStatus($status);

        $this->assertInstanceOf(TransactionStatusContract::class, $this->abstractTransactionMock->getStatus());
        $this->assertSame($status, $this->abstractTransactionMock->getStatus());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setTotalAmount()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getTotalAmount()
     *
     * @throws ReflectionException
     */
    public function testCanGetAndSetTotalAmount()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'totalAmount');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $totalAmount = (new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD');

        $this->abstractTransactionMock->setTotalAmount($totalAmount);

        $this->assertInstanceOf(CurrencyAmount::class, $this->abstractTransactionMock->getTotalAmount());
        $this->assertSame($totalAmount, $this->abstractTransactionMock->getTotalAmount());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getType()
     * @throws ReflectionException
     */
    public function testCanGetType()
    {
        TestHelpers::setInaccessibleProperty($this->abstractTransactionMock, AbstractTransaction::class, 'type', 'test');

        $this->assertEquals('test', $this->abstractTransactionMock->getType());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::getProviderName()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction::setProviderName()
     * @throws ReflectionException
     */
    public function testCanGetAndSetProviderName()
    {
        $property = TestHelpers::getInaccessibleProperty(AbstractTransaction::class, 'providerName');

        $this->assertNull($property->getValue($this->abstractTransactionMock));

        $this->abstractTransactionMock->setProviderName('test');

        $this->assertEquals('test', $this->abstractTransactionMock->getProviderName());
    }

    /**
     * Gets a mock instance implementing the TransactionStatusContract.
     *
     * @return TransactionStatusContract
     */
    private function mockTransactionStatusContract() : TransactionStatusContract
    {
        return new class() implements TransactionStatusContract {
            use HasLabelTrait;
        };
    }
}
