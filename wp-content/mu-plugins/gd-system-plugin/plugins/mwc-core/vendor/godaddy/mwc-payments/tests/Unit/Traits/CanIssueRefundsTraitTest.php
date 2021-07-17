<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Events\Events;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssueRefundsTrait;
use Mockery;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssueRefundsTrait
 */
class CanIssueRefundsTraitTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssueRefundsTrait::refund()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanRefund()
    {
        $traitMock = $this->getMockForTrait(
            CanIssueRefundsTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $adapterClass = get_class(TestHelpers::getDataSourceAdapterContractMock());

        CommonTestHelpers::getInaccessibleProperty(get_class($traitMock), 'refundTransactionAdapter')->setValue($traitMock, $adapterClass);

        $transaction = new RefundTransaction();

        $this->mockStaticMethod(Events::class, 'broadcast')->withAnyArgs()->once();
        $traitMock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($transaction, $this->isInstanceOf($adapterClass))
            ->willReturn($transaction);

        $this->assertEquals($transaction, $traitMock->refund($transaction));
    }
}
