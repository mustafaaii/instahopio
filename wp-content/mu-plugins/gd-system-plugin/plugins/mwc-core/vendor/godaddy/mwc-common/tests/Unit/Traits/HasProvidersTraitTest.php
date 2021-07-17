<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Common\Traits\HasProvidersTrait;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasProvidersTrait
 */
final class HasProvidersTraitTest extends TestCase
{
    /** @var HasProvidersTrait */
    protected $instance;

    public function setUp() : void
    {
        $this->instance = $this->getMockForTrait(HasProvidersTrait::class);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasProvidersTrait::getProviders()
     * @throws ReflectionException
     */
    public function testCanGetProviders()
    {
        $providers = ['providerName' => $this->getProviderImplementation()];

        TestHelpers::setInaccessibleProperty($this->instance, get_class($this->instance), 'providers', $providers);

        $this->assertSame($providers, $this->instance->getProviders());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasProvidersTrait::provider()
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanGetSpecificProvider()
    {
        $providers = ['poynt' => $this->getProviderImplementation()];

        TestHelpers::setInaccessibleProperty($this->instance, get_class($this->instance), 'providers', $providers);

        $this->assertSame($providers['poynt'], $this->instance->provider('poynt'));
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Traits\HasProvidersTrait::provider()
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanFailWhenProviderNoFound()
    {
        $providers = ['mockProvider' => $this->getProviderImplementation()];

        TestHelpers::setInaccessibleProperty($this->instance, get_class($this->instance), 'providers', $providers);

        $this->expectException(Exception::class);
        $this->expectDeprecationMessage('The given provider poynt is not found.');

        $this->instance->provider('poynt');
    }

    /**
     * Gets a ProviderContract mocked implementation.
     *
     * @return ProviderContract
     */
    private function getProviderImplementation() : ProviderContract
    {
        return new class() implements ProviderContract {
            use HasLabelTrait;

            private $description;

            public function getDescription() : string
            {
                return $this->description;
            }

            public function setDescription(string $value) : ProviderContract
            {
                $this->description = $value;

                return $this;
            }
        };
    }
}
