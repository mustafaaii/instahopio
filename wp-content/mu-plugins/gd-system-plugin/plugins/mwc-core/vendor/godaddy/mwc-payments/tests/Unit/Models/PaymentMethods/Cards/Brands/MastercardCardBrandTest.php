<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods\Cards\Brands;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MastercardCardBrand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MastercardCardBrand
 */
class MastercardCardBrandTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MastercardCardBrand::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('mastercard', (new MastercardCardBrand())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MastercardCardBrand::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Mastercard', (new MastercardCardBrand())->getLabel());
    }
}
