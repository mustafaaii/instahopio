<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Events\Events;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpers;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssueCapturesTrait;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssueCapturesTrait
 */
class CanIssueCapturesTraitTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanIssueCapturesTrait::capture()
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanCaptureTransaction()
    {
        $traitMock = $this->getMockForTrait(
            CanIssueCapturesTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doAdaptedRequest']
        );

        $adapterClass = get_class(TestHelpers::getDataSourceAdapterContractMock());

        CommonTestHelpers::getInaccessibleProperty(get_class($traitMock), 'captureTransactionAdapter')->setValue($traitMock, $adapterClass);

        $captureTransaction = new CaptureTransaction();

        $this->mockStaticMethod(Events::class, 'broadcast')->withAnyArgs()->once();
        $traitMock->expects($this->once())
            ->method('doAdaptedRequest')
            ->with($captureTransaction, $this->isInstanceOf($adapterClass))
            ->willReturn($captureTransaction);

        $this->assertInstanceOf(CaptureTransaction::class, $traitMock->capture($captureTransaction));
    }
}
