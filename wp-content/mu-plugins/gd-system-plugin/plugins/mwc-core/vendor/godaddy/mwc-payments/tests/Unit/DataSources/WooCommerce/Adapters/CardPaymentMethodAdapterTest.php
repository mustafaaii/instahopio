<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\DataSources\WooCommerce\Adapters;

use DateTime;
use Exception;
use GoDaddy\WordPress\MWC\Payments\Contracts\CardBrandContract;
use GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CardPaymentMethodAdapter;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\AmericanExpressCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\CreditCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DebitCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DinersClubCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\DiscoverCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MaestroCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\MastercardCardBrand;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\VisaCardBrand;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use Mockery;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use WC_Payment_Token;
use WC_Payment_Token_CC;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CardPaymentMethodAdapter
 */
class CardPaymentMethodAdapterTest extends TestCase
{
    /**
     * Tests that can convert a WooCommerce credit card payment token into a native card payment method.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CardPaymentMethodAdapter::convertFromSource()
     * @dataProvider providerCardData
     *
     * @param int $id
     * @param string $remoteId
     * @param int $customerId
     * @param string $bin
     * @param CardBrandContract $brand
     * @param string $lastFour
     * @param string $expYear
     * @param string $expMonth
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @throws Exception
     */
    public function testCanConvertFromSource(int $id, string $remoteId, int $customerId, string $bin, CardBrandContract $brand, string $lastFour, string $expYear, string $expMonth, DateTime $createdAt, DateTime $updatedAt)
    {
        $woocommercePaymentToken = Mockery::namedMock(WC_Payment_Token_CC::class, WC_Payment_Token::class);

        $woocommercePaymentToken->shouldReceive('get_id')
                                ->once()
                                ->andReturn($id);
        $woocommercePaymentToken->shouldReceive('get_gateway_id')
                                ->once()
                                ->andReturn('fake');
        $woocommercePaymentToken->shouldReceive('get_token')
                                ->once()
                                ->andReturn($remoteId);
        $woocommercePaymentToken->shouldReceive('get_user_id')
                                ->once()
                                ->andReturn($customerId);
        $woocommercePaymentToken->shouldReceive('get_last4')
                                ->once()
                                ->andReturn($lastFour);
        $woocommercePaymentToken->shouldReceive('get_card_type')
                                ->once()
                                ->andReturn($brand->getName());
        $woocommercePaymentToken->shouldReceive('get_expiry_year')
                                ->once()
                                ->andReturn($expYear);
        $woocommercePaymentToken->shouldReceive('get_expiry_month')
                                ->once()
                                ->andReturn($expMonth);
        $woocommercePaymentToken->shouldReceive('get_meta')
                                ->once()
                                ->with(CardPaymentMethodAdapter::CREATED_AT_META_KEY)
                                ->andReturn($createdAt->format('c'));
        $woocommercePaymentToken->shouldReceive('get_meta')
                                ->once()
                                ->with(CardPaymentMethodAdapter::UPDATED_AT_META_KEY)
                                ->andReturn($updatedAt->format('c'));
        $woocommercePaymentToken->shouldReceive('get_meta')
                                ->once()
                                ->with(CardPaymentMethodAdapter::BIN_META_KEY)
                                ->andReturn($bin);

        $nativePaymentMethod = (new CardPaymentMethodAdapter($woocommercePaymentToken))->convertFromSource();

        $this->assertEquals($id, $nativePaymentMethod->getId());
        $this->assertEquals($remoteId, $nativePaymentMethod->getRemoteId());
        $this->assertEquals($customerId, $nativePaymentMethod->getCustomerId());
        $this->assertEquals($brand->getName(), $nativePaymentMethod->getBrand()->getName());
        $this->assertEquals($bin, $nativePaymentMethod->getBin());
        $this->assertEquals($lastFour, $nativePaymentMethod->getLastFour());
        $this->assertEquals($expYear, $nativePaymentMethod->getExpirationYear());
        $this->assertEquals($expMonth, $nativePaymentMethod->getExpirationMonth());
        $this->assertEquals($createdAt->getTimestamp(), $nativePaymentMethod->getCreatedAt()->getTimestamp());
        $this->assertEquals($updatedAt->getTimestamp(), $nativePaymentMethod->getUpdatedAt()->getTimestamp());
    }

    /**
     * Tests that can convert a native card payment method into a WooCommerce credit card payment token.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CardPaymentMethodAdapter::convertToSource()
     * @dataProvider providerCardData
     *
     * @param int $id
     * @param string $remoteId
     * @param int $customerId
     * @param string $bin
     * @param CardBrandContract $brand
     * @param string $lastFour
     * @param string $expYear
     * @param string $expMonth
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function testCanCovertToSource(int $id, string $remoteId, int $customerId, string $bin, CardBrandContract $brand, string $lastFour, string $expYear, string $expMonth, DateTime $createdAt, DateTime $updatedAt)
    {
        $nativePaymentMethod = (new CardPaymentMethod())
            ->setId($id)
            ->setRemoteId($remoteId)
            ->setCustomerId($customerId)
            ->setBin($bin)
            ->setBrand($brand)
            ->setLastFour($lastFour)
            ->setExpirationYear($expYear)
            ->setExpirationMonth($expMonth)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->setProviderName('fake');

        $woocommercePaymentToken = Mockery::namedMock(WC_Payment_Token_CC::class, WC_Payment_Token::class);

        $woocommercePaymentToken->shouldReceive('set_id')
                                ->once()
                                ->with($nativePaymentMethod->getId());
        $woocommercePaymentToken->shouldReceive('set_gateway_id')
                                ->once()
                                ->with('fake');
        $woocommercePaymentToken->shouldReceive('set_token')
                                ->once()
                                ->with($nativePaymentMethod->getRemoteId());
        $woocommercePaymentToken->shouldReceive('set_user_id')
                                ->once()
                                ->with($nativePaymentMethod->getCustomerId());
        $woocommercePaymentToken->shouldReceive('set_last4')
                                ->once()
                                ->with($nativePaymentMethod->getLastFour());
        $woocommercePaymentToken->shouldReceive('update_meta_data')
                                ->once()
                                ->withArgs([CardPaymentMethodAdapter::CREATED_AT_META_KEY, $nativePaymentMethod->getCreatedAt()->format('c')]);
        $woocommercePaymentToken->shouldReceive('update_meta_data')
                                ->once()
                                ->withArgs([CardPaymentMethodAdapter::UPDATED_AT_META_KEY, $nativePaymentMethod->getUpdatedAt()->format('c')]);
        $woocommercePaymentToken->shouldReceive('update_meta_data')
                                ->once()
                                ->withArgs([CardPaymentMethodAdapter::BIN_META_KEY, $nativePaymentMethod->getBin()]);

        $woocommercePaymentToken->shouldReceive('set_card_type')
                                ->once()
                                ->with($nativePaymentMethod->getBrand()->getName());
        $woocommercePaymentToken->shouldReceive('set_expiry_year')
                                ->once()
                                ->with($nativePaymentMethod->getExpirationYear());
        $woocommercePaymentToken->shouldReceive('set_expiry_month')
                                ->once()
                                ->with($nativePaymentMethod->getExpirationMonth());

        $adapter = new CardPaymentMethodAdapter($woocommercePaymentToken);

        $this->assertInstanceOf(WC_Payment_Token_CC::class, $adapter->convertToSource($nativePaymentMethod));
    }

    /** @see CardPaymentMethodAdapterTest tests */
    public function providerCardData() : array
    {
        return [
            [123, '123', 789, 'test-bank', new VisaCardBrand(), '9999', '25', '12', new DateTime('yesterday'), new DateTime('now')],
            [456, '456', 789, 'another-test', new MastercardCardBrand(), '1111', '25', '12', new DateTime('yesterday'), new DateTime('now')]
        ];
    }

    /**
     * Tests that can convert a card brand from source.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\CardPaymentMethodAdapter::convertCardBrandFromSource()
     * @dataProvider providerCardBrandIdentifiers
     *
     * @param string $cardBrandIdentifier
     * @param string $cardBrandClassName
     * @throws ReflectionException
     */
    public function testConvertCardBrandFromSource(string $cardBrandIdentifier, string $cardBrandClassName)
    {
        $source = Mockery::namedMock(WC_Payment_Token_CC::class, WC_Payment_Token::class);
        $source->shouldReceive('get_card_type')->andReturn($cardBrandIdentifier);

        $adapter = new CardPaymentMethodAdapter($source);
        $method = TestHelpers::getInaccessibleMethod($adapter, 'convertCardBrandFromSource');

        $this->assertInstanceOf($cardBrandClassName, $method->invoke($adapter));
    }

    /** @see testConvertCardBrandFromSource */
    public function providerCardBrandIdentifiers() : array
    {
        return [
            ['american-express', AmericanExpressCardBrand::class],
            ['diners-club', DinersClubCardBrand::class],
            ['discover', DiscoverCardBrand::class],
            ['maestro', MaestroCardBrand::class],
            ['mastercard', MastercardCardBrand::class],
            ['visa', VisaCardBrand::class],
            ['debit', DebitCardBrand::class],
            ['credit', CreditCardBrand::class],
        ];
    }
}
