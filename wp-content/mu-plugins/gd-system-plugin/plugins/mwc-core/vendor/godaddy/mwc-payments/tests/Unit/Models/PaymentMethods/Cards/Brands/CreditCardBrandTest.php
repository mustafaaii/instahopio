<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods\Cards\Brands;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\CreditCardBrand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\CreditCardBrand
 */
class CreditCardBrandTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\CreditCardBrand::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('credit', (new CreditCardBrand())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\CreditCardBrand::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Credit Card', (new CreditCardBrand())->getLabel());
    }
}
