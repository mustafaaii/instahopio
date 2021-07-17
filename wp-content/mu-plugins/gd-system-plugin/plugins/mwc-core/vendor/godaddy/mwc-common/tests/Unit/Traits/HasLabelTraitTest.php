<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait
 */
final class HasLabelTraitTest extends TestCase
{
    /**
     * Tests that can get the name.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait::getName()
     */
    public function testCanGetName()
    {
        $trait = $this->getMockInstance();

        $this->assertEquals('', $trait->getName());

        $trait->setName('my-name');

        $this->assertEquals('my-name', $trait->getName());
    }

    /**
     * Tests that can get the label.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait::getLabel()
     */
    public function testCanGetLabel()
    {
        $trait = $this->getMockInstance();

        $this->assertEquals('', $trait->getLabel());

        $trait->setLabel('my-label');

        $this->assertEquals('my-label', $trait->getLabel());
    }

    /**
     * Tests that can set the name.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait::setName()
     */
    public function testCanSetName()
    {
        $trait = $this->getMockInstance();
        $reflection = new ReflectionClass($trait);
        $property = $reflection->getProperty('name');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($trait));

        $trait->setName('my-name');

        $this->assertEquals('my-name', $property->getValue($trait));
    }

    /**
     * Tests that can set the label.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait::setLabel()
     */
    public function testCanSetLabel()
    {
        $trait = $this->getMockInstance();
        $reflection = new ReflectionClass($trait);
        $property = $reflection->getProperty('label');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($trait));

        $trait->setLabel('my-label');

        $this->assertEquals('my-label', $property->getValue($trait));
    }

    /**
     * Gets a mock instance implementing the trait.
     *
     * @return object|HasLabelTrait
     */
    private function getMockInstance()
    {
        return new class() {
            use HasLabelTrait;
        };
    }
}
