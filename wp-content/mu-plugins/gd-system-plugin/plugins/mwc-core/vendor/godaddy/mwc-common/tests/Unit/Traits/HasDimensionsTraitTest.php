<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Models\Dimensions;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\HasDimensionsTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasDimensionsTrait
 */
class HasDimensionsTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasDimensionsTrait::getDimensions()
     */
    public function testCanGetDimensions()
    {
        $instance = $this->getMockInstance();
        $dimensions = new Dimensions();

        $instance->setDimensions($dimensions);

        $this->assertSame($dimensions, $instance->getDimensions());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasDimensionsTrait::setDimensions()
     *
     * @throws ReflectionException
     */
    public function testCanSetDimensions()
    {
        $instance = $this->getMockInstance();
        $property = TestHelpers::getInaccessibleProperty($instance, 'dimensions');
        $dimensions = new Dimensions();

        $this->assertNull($property->getValue($instance));

        $this->assertInstanceOf(get_class($instance), $instance->setDimensions($dimensions));

        $this->assertSame($dimensions, $property->getValue($instance));
    }

    /**
     * Gets the instance of a class that implements the trait.
     *
     * @return object|HasDimensionsTrait
     */
    public function getMockInstance()
    {
        return new class()
        {
            use HasDimensionsTrait;
        };
    }
}
