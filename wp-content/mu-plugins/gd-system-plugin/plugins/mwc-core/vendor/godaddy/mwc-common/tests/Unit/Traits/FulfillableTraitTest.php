<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Contracts\FulfillmentStatusContract;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\FullfillableTrait
 */
final class FulfillableTraitTest extends TestCase
{
    /**
     * Tests that can get the fulfillment status.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait::getFulfillmentStatus()
     */
    public function testCanGetFulfillmentStatus()
    {
        $trait  = $this->getMockInstance();
        $status = $this->getFulfillmentStatusMockInstance();

        $this->assertNull($trait->getFulfillmentStatus());

        $trait->setFulfillmentStatus($status);

        $this->assertSame($status, $trait->getFulfillmentStatus());
    }

    /**
     * Tests that can set the fulfillment status.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait::setFulfillmentStatus()
     *
     * @throws ReflectionException
     */
    public function testCanSetFulfillmentStatus()
    {
        $trait  = $this->getMockInstance();
        $status = $this->getFulfillmentStatusMockInstance();

        $property = TestHelpers::getInaccessibleProperty($trait, 'fulfillmentStatus');

        $trait->setFulfillmentStatus($status);

        $this->assertSame($status, $property->getValue($trait));
    }

    /**
     * Tests that can get the needs shipping property.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait::getNeedsShipping()
     */
    public function testCanGetNeedsShipping()
    {
        $trait = $this->getMockInstance();

        $this->assertFalse($trait->getNeedsShipping());

        $trait->setNeedsShipping(true);

        $this->assertTrue($trait->getNeedsShipping());
    }

    /**
     * Tests that can set the needs shipping property.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait::setNeedsShipping()
     */
    public function testCanSetNeedsShipping()
    {
        $trait = $this->getMockInstance();
        $reflection = new ReflectionClass($trait);
        $property = $reflection->getProperty('needsShipping');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($trait));

        $trait->setNeedsShipping(true);

        $this->assertTrue($property->getValue($trait));
        $this->assertSame($trait, $trait->setNeedsShipping(true));
    }

    /**
     * Gets a mock instance implementing the trait.
     *
     * @return FulfillableTrait
     */
    private function getMockInstance()
    {
        return new class()
        {
            use FulfillableTrait;
        };
    }

    /**
     * Gets a FulfillmentStatusContract mock implementation.
     *
     * @return FulfillmentStatusContract
     */
    private function getFulfillmentStatusMockInstance() : FulfillmentStatusContract
    {
        return new class() implements FulfillmentStatusContract
        {
            use HasLabelTrait;
        };
    }
}
