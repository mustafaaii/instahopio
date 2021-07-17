<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods\Cards\Brands;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DiscoverCardBrand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DiscoverCardBrand
 */
class DiscoverCardBrandTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DiscoverCardBrand::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('discover', (new DiscoverCardBrand())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DiscoverCardBrand::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Discover', (new DiscoverCardBrand())->getLabel());
    }
}
