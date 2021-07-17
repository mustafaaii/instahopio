<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods\Cards\Brands;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DebitCardBrand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DebitCardBrand
 */
class DebitCardBrandTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DebitCardBrand::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('debit', (new DebitCardBrand())->getName());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DebitCardBrand::getLabel()
     */
    public function testCanGetLabel()
    {
        $this->assertEquals('Debit Card', (new DebitCardBrand())->getLabel());
    }
}
