<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Models\Dimensions;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions
 */
final class DimensionsTest extends TestCase
{
    /**
     * Tests that can get a dimension value.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::getHeight()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::getLength()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::getWidth()
     *
     * @dataProvider providerCanGetValue
     */
    public function testCanGetValue($property)
    {
        $dimensions = new Dimensions();

        $getMethod = 'get'.$property;
        $setMethod = 'set'.$property;

        $this->assertEquals(0, $dimensions->$getMethod());

        $dimensions->$setMethod(100);

        $this->assertEquals(100, $dimensions->$getMethod());
    }

    /** @see testCanGetValue */
    public function providerCanGetValue() : array
    {
        return [
            'Height' => ['Height'],
            'Length' => ['Length'],
            'Width'  => ['Width'],
        ];
    }

    /**
     * Tests that can set a dimension value.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::setHeight()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::setLength()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::setWidth()
     *
     * @throws ReflectionException
     *
     * @dataProvider providerCanSetValue
     */
    public function testCanSetValue($property)
    {
        $dimensions = new Dimensions();

        $reflectionProperty = TestHelpers::getInaccessibleProperty($dimensions, $property);

        $setMethod = 'set'.ucfirst($property);

        $this->assertNull($reflectionProperty->getValue($dimensions));

        $self = $dimensions->$setMethod(100);

        $this->assertInstanceOf(Dimensions::class, $self);
        $this->assertEquals(100, $reflectionProperty->getValue($dimensions));
    }

    /** @see testCanSetValue */
    public function providerCanSetValue() : array
    {
        return [
            'Height' => ['height'],
            'Length' => ['length'],
            'Width'  => ['width'],
        ];
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::setUnitOfMeasurement()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Dimensions::getUnitOfMeasurement()
     */
    public function testCanAccessTraitMethods()
    {
        $dimensions = (new Dimensions())->setUnitOfMeasurement('cm');

        $this->assertInstanceOf(Dimensions::class, $dimensions);
        $this->assertSame('cm', $dimensions->getUnitOfMeasurement());
    }
}
