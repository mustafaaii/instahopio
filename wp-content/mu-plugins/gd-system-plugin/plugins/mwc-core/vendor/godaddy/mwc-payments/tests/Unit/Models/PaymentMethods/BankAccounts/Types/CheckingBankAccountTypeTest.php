<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods\BankAccounts\Types;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccounts\Types\CheckingBankAccountType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccounts\Types\CheckingBankAccountType
 */
class CheckingBankAccountTypeTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccounts\Types\CheckingBankAccountType::getName
     */
    public function testCanGetName()
    {
        $this->assertEquals('checking', (new CheckingBankAccountType())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccounts\Types\CheckingBankAccountType::getLabel
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Checking Account', (new CheckingBankAccountType())->getLabel());
    }
}
