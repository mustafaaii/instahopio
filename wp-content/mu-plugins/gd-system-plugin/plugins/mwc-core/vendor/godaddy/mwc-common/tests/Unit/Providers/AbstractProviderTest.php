<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Providers;

use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider
 */
class AbstractProviderTest extends TestCase
{
    /** @var AbstractProvider|\PHPUnit\Framework\MockObject\MockObject */
    protected $abstractProviderMock;

    /**
     * Runs before every test.
     */
    protected function setUp() : void
    {
        $this->abstractProviderMock = $this->getMockForAbstractClass(AbstractProvider::class);
    }

    /**
     * Tests that can throw an exception when calling an undefined method.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::__call()
     */
    public function testWrongMethodRaisesException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Call to undefined method GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::nonExistantMethod');

        $this->abstractProviderMock->nonExistantMethod();
    }

    /**
     * Tests that can set and get the provider's name.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::getName()
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::setName()
     */
    public function testCanSetGetName()
    {
        $this->assertInstanceOf(AbstractProvider::class, $this->abstractProviderMock->setName('Test name'));

        $this->assertEquals('Test name', $this->abstractProviderMock->getName());
    }

    /**
     * Tests that can set and get the provider's label
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::getLabel()
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::setLabel()
     */
    public function testCanSetGetLabel()
    {
        $this->assertInstanceOf(AbstractProvider::class, $this->abstractProviderMock->setLabel('Test label'));

        $this->assertEquals('Test label', $this->abstractProviderMock->getLabel());
    }

    /**
     * Tests that can set and get the provider's description.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::getDescription()
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider::setDescription()
     */
    public function testCanSetGetDescription()
    {
        $this->assertInstanceOf(AbstractProvider::class, $this->abstractProviderMock->setDescription('Test description'));

        $this->assertEquals('Test description', $this->abstractProviderMock->getDescription());
    }
}
