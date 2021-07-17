<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods\Cards\Brands;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\VisaCardBrand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\VisaCardBrand
 */
class VisaCardBrandTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\VisaCardBrand::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('visa', (new VisaCardBrand())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\VisaCardBrand::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Visa', (new VisaCardBrand())->getLabel());
    }
}
