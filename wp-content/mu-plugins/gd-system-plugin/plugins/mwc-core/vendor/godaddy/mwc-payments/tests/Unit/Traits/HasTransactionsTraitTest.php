<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CommonTestHelpers;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Traits\HasTransactionsTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\HasTransactionsTrait
 */
class HasTransactionsTraitTest extends TestCase
{
    /**
     * Test can get transactions gateway instance.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\HasTransactionsTrait::transactions()
     *
     * @throws ReflectionException
     */
    public function testCanGetTransactionsInstance()
    {
        $gatewayMockClass = get_class(TestHelpers::getMockGateway());

        $traitMock = $this->getMockForTrait(HasTransactionsTrait::class);

        CommonTestHelpers::getInaccessibleProperty(get_class($traitMock), 'transactionsGateway')->setValue($traitMock, $gatewayMockClass);

        $this->assertInstanceOf($gatewayMockClass, $traitMock->transactions());
    }
}
