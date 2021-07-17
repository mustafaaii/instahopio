<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Models\Weight;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\Weight
 */
final class WeightTest extends TestCase
{
    /**
     * Tests that can get the value.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Weight::getValue()
     */
    public function testCanGetValue()
    {
        $weight = new Weight();

        $this->assertEquals(0, $weight->getValue());

        $weight->setValue(100);

        $this->assertEquals(100, $weight->getValue());
    }

    /**
     * Tests that can set the value.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Weight::setValue()
     *
     * @throws ReflectionException
     */
    public function testCanSetValue()
    {
        $weight = new Weight();

        $property = TestHelpers::getInaccessibleProperty($weight, 'value');

        $this->assertNull($property->getValue($weight));

        $self = $weight->setValue(100);

        $this->assertInstanceOf(Weight::class, $self);
        $this->assertEquals(100, $property->getValue($weight));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Weight::setUnitOfMeasurement()
     * @covers \GoDaddy\WordPress\MWC\Common\Models\Weight::getUnitOfMeasurement()
     */
    public function testCanAccessTraitMethods()
    {
        $weight = (new Weight())->setUnitOfMeasurement('kg');

        $this->assertInstanceOf(Weight::class, $weight);
        $this->assertSame('kg', $weight->getUnitOfMeasurement());
    }
}
