<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Events\Events;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssueVoidsTrait;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssueVoidsTrait
 */
class CanIssueVoidsTraitTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssueVoidsTrait::void()
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanVoidTransaction()
    {
        $traitMock = $this->getMockForTrait(
            CanIssueVoidsTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $adapterClass = get_class(TestHelpers::getDataSourceAdapterContractMock());

        CommonTestHelpers::getInaccessibleProperty(get_class($traitMock), 'voidTransactionAdapter')
            ->setValue($traitMock, $adapterClass);

        $voidTransaction = new VoidTransaction();

        $traitMock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($voidTransaction, $this->isInstanceOf($adapterClass))
            ->willReturn($voidTransaction);

        // tests that the Events::broadcast method was called
        $this->mockStaticMethod(Events::class, 'broadcast')->withAnyArgs()->once();

        $this->assertInstanceOf(VoidTransaction::class, $traitMock->void($voidTransaction));
    }
}
