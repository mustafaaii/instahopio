<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Models\Weight;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\HasWeightTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasWeightTrait
 */
class HasWeightTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasWeightTrait::getWeight()
     */
    public function testCanGetWeight()
    {
        $instance = $this->getMockInstance();
        $weight = new Weight();
        $instance->setWeight($weight);

        $this->assertSame($weight, $instance->getWeight());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasWeightTrait::setWeight()
     *
     * @throws ReflectionException
     */
    public function testCanSetWeight()
    {
        $instance = $this->getMockInstance();
        $weight = new Weight();
        $property = TestHelpers::getInaccessibleProperty($instance, 'weight');

        $this->assertNull($property->getValue($instance));

        $this->assertInstanceOf(get_class($instance), $instance->setWeight($weight));

        $this->assertSame($weight, $property->getValue($instance));
    }

    /**
     * Gets an instance of a class implementing the trait.
     *
     * @return object|HasWeightTrait
     */
    private function getMockInstance()
    {
        return new class()
        {
            use HasWeightTrait;
        };
    }
}

