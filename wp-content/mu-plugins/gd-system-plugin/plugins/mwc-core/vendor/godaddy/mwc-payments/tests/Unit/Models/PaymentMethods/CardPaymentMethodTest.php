<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Models\PaymentMethods;

use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\AmericanExpressCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\CreditCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DebitCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DinersClubCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DiscoverCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MaestroCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MastercardCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\VisaCardBrand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod
 */
class CardPaymentMethodTest extends TestCase
{
    /** @var CardPaymentMethod */
    protected $cardPaymentMethod;

    /**
     * Runs before every test.
     */
    protected function setUp() : void
    {
        $this->cardPaymentMethod = new CardPaymentMethod();
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::getBin()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::setBin()
     */
    public function testCanGetAndSetBin()
    {
        $this->assertNull($this->cardPaymentMethod->getBin());

        $bin = '483312';

        $this->cardPaymentMethod->setBin($bin);

        $this->assertEquals($bin, $this->cardPaymentMethod->getBin());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::getBrand()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::setBrand()
     * @dataProvider providerCardBrand
     *
     * @param string $cardBrandClass
     */
    public function testCanGetAndSetBrand(string $cardBrandClass)
    {
        $this->assertNull($this->cardPaymentMethod->getBrand());

        $brand = new $cardBrandClass();

        $this->cardPaymentMethod->setBrand($brand);

        $this->assertInstanceOf($cardBrandClass, $this->cardPaymentMethod->getBrand());
    }

    /** @see testCanGetAndSetBrand */
    public function providerCardBrand() : array
    {
        return [
            [AmericanExpressCardBrand::class],
            [CreditCardBrand::class],
            [DebitCardBrand::class],
            [DinersClubCardBrand::class],
            [DiscoverCardBrand::class],
            [MaestroCardBrand::class],
            [MastercardCardBrand::class],
            [VisaCardBrand::class],
        ];
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::getExpirationMonth()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::setExpirationMonth()
     */
    public function testCanGetAndSetExpirationMonth()
    {
        $this->assertNull($this->cardPaymentMethod->getExpirationMonth());

        $expirationMonth = '04';

        $this->cardPaymentMethod->setExpirationMonth($expirationMonth);

        $this->assertEquals($expirationMonth, $this->cardPaymentMethod->getExpirationMonth());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::getExpirationYear()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::setExpirationYear()
     */
    public function testCanGetAndSetExpirationYear()
    {
        $this->assertNull($this->cardPaymentMethod->getExpirationYear());

        $expirationYear = '21';

        $this->cardPaymentMethod->setExpirationYear($expirationYear);

        $this->assertEquals($expirationYear, $this->cardPaymentMethod->getExpirationYear());
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::getLastFour()
     * @covers \GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod::setLastFour()
     */
    public function testCanGetAndSetLastFour()
    {
        $this->assertNull($this->cardPaymentMethod->getLastFour());

        $lastFour = '4242';

        $this->cardPaymentMethod->setLastFour($lastFour);

        $this->assertEquals($lastFour, $this->cardPaymentMethod->getLastFour());
    }
}
