<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods;

use GoDaddy\WordPress\MWC\Common\Contracts\HasLabelContract;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Payments\Contracts\BankAccountTypeContract;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod
 */
class BankAccountPaymentMethodTest extends TestCase
{
    /**
     * @var BankAccountPaymentMethod
     */
    protected $bankAccountPaymentMethod;

    protected function setUp() : void
    {
        $this->bankAccountPaymentMethod = new BankAccountPaymentMethod();
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod::getType()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod::setType()
     */
    public function testCanGetAndSetType()
    {
        $this->assertNull($this->bankAccountPaymentMethod->getType());

        $type = $this->mockBankAccountType();

        $this->bankAccountPaymentMethod->setType($type);

        $this->assertEquals($type, $this->bankAccountPaymentMethod->getType());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod::getLastFour()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod::setLastFour()
     */
    public function testCanGetAndSetLastFour()
    {
        $this->assertNull($this->bankAccountPaymentMethod->getLastFour());

        $lastFour = '4242';

        $this->bankAccountPaymentMethod->setLastFour($lastFour);

        $this->assertEquals($lastFour, $this->bankAccountPaymentMethod->getLastFour());
    }

    /**
     * Gets a mock instance implementing the BankAccountTypeContract.
     *
     * @return BankAccountTypeContract
     */
    public function mockBankAccountType() : BankAccountTypeContract
    {
        return new class() implements BankAccountTypeContract {
            use HasLabelTrait;

            public function __construct()
            {
                $this->setName('MockName')->setLabel('MockLabel');
            }

            /**
             * @param string|null $label
             *
             * @return HasLabelContract
             */
            public function setLabel(string $label) : HasLabelContract
            {
                $this->label = $label;

                return $this;
            }

            /**
             * @param string|null $name
             *
             * @return HasLabelContract
             */
            public function setName(string $name) : HasLabelContract
            {
                $this->name = $name;

                return $this;
            }
        };
    }
}
