<?php

namespace GoDaddy\WordPress\MWC\Common\Tests\Unit\Models;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @covers \GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount
 */
final class CurrencyAmountTest extends TestCase
{
    /**
     * Tests that can get the amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount::getAmount()
     */
    public function testCanGetAmount()
    {
        $currencyAmount = new CurrencyAmount();

        $this->assertEquals(0, $currencyAmount->getAmount());

        $currencyAmount->setAmount(100);

        $this->assertEquals(100, $currencyAmount->getAmount());
    }

    /**
     * Tests that can get the currency code.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount::getCurrencyCode()
     */
    public function testCanGetCurrencyCode()
    {
        $currencyAmount = new CurrencyAmount();

        $this->assertEquals('', $currencyAmount->getCurrencyCode());

        $currencyAmount->setCurrencyCode('EUR');

        $this->assertEquals('EUR', $currencyAmount->getCurrencyCode());
    }

    /**
     * Tests that can set the amount.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount::setAmount()
     */
    public function testCanSetAmount()
    {
        $currencyAmount = new CurrencyAmount();
        $reflection = new ReflectionClass($currencyAmount);
        $property = $reflection->getProperty('amount');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($currencyAmount));

        $currencyAmount->setAmount(100);

        $this->assertEquals(100, $property->getValue($currencyAmount));
    }

    /**
     * Tests that can set the currency code.
     *
     * @covers \GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount::setCurrencyCode()
     */
    public function testCanSetCurrencyCode()
    {
        $currencyAmount = new CurrencyAmount();
        $reflection = new ReflectionClass($currencyAmount);
        $property = $reflection->getProperty('currencyCode');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($currencyAmount));

        $currencyAmount->setCurrencyCode('EUR');

        $this->assertEquals('EUR', $property->getValue($currencyAmount));
    }
}
