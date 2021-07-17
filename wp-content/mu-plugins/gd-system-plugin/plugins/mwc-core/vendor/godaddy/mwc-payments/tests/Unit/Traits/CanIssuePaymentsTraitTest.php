<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Events\Events;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpersAlias;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssuePaymentsTrait;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssuePaymentsTrait
 */
class CanIssuePaymentsTraitTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssuePaymentsTrait::pay()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanPay()
    {
        $mock = $this->getMockForTrait(
            CanIssuePaymentsTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $adapterClass = get_class(TestHelpers::getDataSourceAdapterContractMock());

        CommonTestHelpersAlias::getInaccessibleProperty(get_class($mock), 'paymentTransactionAdapter')->setValue($mock, $adapterClass);

        $transaction = new PaymentTransaction();
        $value = (new CurrencyAmount())->setAmount(100)->setCurrencyCode('USD');
        $transaction->setAmount($value);

        $mock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($transaction, $this->isInstanceOf($adapterClass))
            ->willReturn($transaction);

        $this->mockStaticMethod(Events::class, 'broadcast')->once()->withAnyArgs();

        $this->assertEquals($transaction, $mock->pay($transaction));
    }
}
