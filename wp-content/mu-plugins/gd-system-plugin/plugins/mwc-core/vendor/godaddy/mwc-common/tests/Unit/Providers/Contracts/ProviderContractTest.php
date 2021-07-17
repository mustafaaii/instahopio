<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Providers\Contracts;

use GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract
 */
class ProviderContractTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract::getDescription()
     * @covers \GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract::setDescription()
     */
    public function testCanImplementProviderContract()
    {
        $implementation = $this->getProviderContractImplementation();

        $this->assertInstanceOf(ProviderContract::class, $implementation->setDescription('description'));
        $this->assertSame('description', $implementation->getDescription());
    }

    /**
     * Gets a ProviderContract mocked implementation.
     *
     * @return ProviderContract
     */
    private function getProviderContractImplementation() : ProviderContract
    {
        return new class() implements ProviderContract {
            use HasLabelTrait;

            private $description;

            public function getDescription(): string {
                return $this->description;
            }

            public function setDescription(string $value): ProviderContract
            {
                $this->description = $value;

                return $this;
            }
        };
    }
}
