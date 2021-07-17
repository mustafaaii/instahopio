<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait
 */
final class HasUnitOfMeasurementTraitTest extends TestCase
{
    /**
     * Tests that can get the unit of measurement.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait::getUnitOfMeasurement()
     */
    public function testCanGetUnitOfMeasurement()
    {
        $trait = $this->getMockInstance();

        $this->assertEquals('', $trait->getUnitOfMeasurement());

        $trait->setUnitOfMeasurement('weight');

        $this->assertEquals('weight', $trait->getUnitOfMeasurement());
    }

    /**
     * Tests that can set the unit of measurement.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait::setUnitOfMeasurement()
     */
    public function testCanSetUnitOfMeasurement()
    {
        $trait = $this->getMockInstance();
        $property = TestHelpers::getInaccessibleProperty($trait, 'unit');

        $this->assertNull($property->getValue($trait));

        $trait->setUnitOfMeasurement('weight');

        $this->assertEquals('weight', $property->getValue($trait));
    }

    /**
     * Gets a mock instance implementing the trait.
     *
     * @return object|HasUnitOfMeasurementTrait
     */
    private function getMockInstance()
    {
        return new class() {
            use HasUnitOfMeasurementTrait;
        };
    }
}
