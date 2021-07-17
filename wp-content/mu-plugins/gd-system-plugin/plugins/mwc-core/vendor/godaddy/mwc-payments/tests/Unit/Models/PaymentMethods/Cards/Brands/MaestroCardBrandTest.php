<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods\Cards\Brands;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MaestroCardBrand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MaestroCardBrand
 */
class MaestroCardBrandTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MaestroCardBrand::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('maestro', (new MaestroCardBrand())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MaestroCardBrand::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Maestro', (new MaestroCardBrand())->getLabel());
    }
}
