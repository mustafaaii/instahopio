<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\DataSources\WooCommerce\Adapters;

use DateTime;
use Exception;
use GoDaddy\WordPress\MWC\Payments\Contracts\BankAccountTypeContract;
use GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\BankAccountPaymentMethodAdapter;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccounts\Types\CheckingBankAccountType;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccounts\Types\SavingsBankAccountType;
use GoDaddy\WordPress\MWC\Payments\Tests\TestHelpers;
use Mockery;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use WC_Payment_Token;
use WC_Payment_Token_ECheck;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\BankAccountPaymentMethodAdapter
 */
class BankAccountPaymentMethodAdapterTest extends TestCase
{
    /**
     * Tests that can convert a WooCommerce credit card payment token into a native card payment method.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\BankAccountPaymentMethodAdapter::convertFromSource
     * @dataProvider providerBankAccountData
     *
     * @param int $id
     * @param BankAccountTypeContract|null $type
     * @param string $remoteId
     * @param int $customerId
     * @param string $lastFour
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @throws Exception
     */
    public function testCanConvertFromSource(int $id, BankAccountTypeContract $type, string $remoteId, int $customerId, string $lastFour, DateTime $createdAt, DateTime $updatedAt)
    {
        $woocommercePaymentToken = Mockery::namedMock(WC_Payment_Token_ECheck::class, WC_Payment_Token::class);

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
        $woocommercePaymentToken->shouldReceive('get_meta')
                                ->once()
                                ->with(BankAccountPaymentMethodAdapter::CREATED_AT_META_KEY)
                                ->andReturn($createdAt->format('c'));
        $woocommercePaymentToken->shouldReceive('get_meta')
                                ->once()
                                ->with(BankAccountPaymentMethodAdapter::UPDATED_AT_META_KEY)
                                ->andReturn($updatedAt->format('c'));
        $woocommercePaymentToken->shouldReceive('get_meta')
                                ->once()
                                ->with(BankAccountPaymentMethodAdapter::ACCOUNT_TYPE_META_KEY)
                                ->andReturn($type->getName());

        $nativePaymentMethod = (new BankAccountPaymentMethodAdapter($woocommercePaymentToken))->convertFromSource();

        $this->assertEquals($id, $nativePaymentMethod->getId());
        $this->assertEquals($remoteId, $nativePaymentMethod->getRemoteId());
        $this->assertEquals($customerId, $nativePaymentMethod->getCustomerId());
        $this->assertEquals($lastFour, $nativePaymentMethod->getLastFour());
        $this->assertEquals($createdAt->getTimestamp(), $nativePaymentMethod->getCreatedAt()->getTimestamp());
        $this->assertEquals($updatedAt->getTimestamp(), $nativePaymentMethod->getUpdatedAt()->getTimestamp());
        $this->assertInstanceOf(get_class($type), $nativePaymentMethod->getType());
    }

    /**
     * Tests that can convert a account type from source.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\BankAccountPaymentMethodAdapter::convertAccountTypeFromSource
     * @dataProvider providerAccountTypeIdentifiers
     *
     * @param string $accountTypeName
     * @param string $accountTypeClassName
     * @throws ReflectionException
     */
    public function testConvertAccountTypeFromSource(string $accountTypeName, string $accountTypeClassName)
    {
        $source = Mockery::namedMock(WC_Payment_Token_ECheck::class, WC_Payment_Token::class);

        $source->shouldReceive('get_meta')
            ->once()
            ->with(BankAccountPaymentMethodAdapter::ACCOUNT_TYPE_META_KEY)
            ->andReturn($accountTypeName);

        $adapter = new BankAccountPaymentMethodAdapter($source);
        $method = TestHelpers::getInaccessibleMethod($adapter, 'convertAccountTypeFromSource');

        $this->assertInstanceOf($accountTypeClassName, $method->invoke($adapter));
    }

    /** @see testConvertAccountTypeFromSource */
    public function providerAccountTypeIdentifiers() : array
    {
        return [
            ['checking', CheckingBankAccountType::class],
            ['savings', SavingsBankAccountType::class],
        ];
    }

    /**
     * Tests that can convert a account type from an unknown source.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\BankAccountPaymentMethodAdapter::convertAccountTypeFromSource
     * @throws ReflectionException
     */
    public function testConvertAccountTypeFromUnknownSource()
    {
        $source = Mockery::namedMock(WC_Payment_Token_ECheck::class, WC_Payment_Token::class);

        $source->shouldReceive('get_meta')
            ->once()
            ->with(BankAccountPaymentMethodAdapter::ACCOUNT_TYPE_META_KEY)
            ->andReturn('unknown');

        $adapter = new BankAccountPaymentMethodAdapter($source);
        $method = TestHelpers::getInaccessibleMethod($adapter, 'convertAccountTypeFromSource');

        $this->assertNull($method->invoke($adapter));
    }

    /**
     * Tests that can convert a native card payment method into a WooCommerce credit card payment token.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\DataSources\WooCommerce\Adapters\BankAccountPaymentMethodAdapter::convertToSource
     * @dataProvider providerBankAccountData
     *
     * @param int $id
     * @param BankAccountTypeContract $type
     * @param string $remoteId
     * @param int $customerId
     * @param string $lastFour
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function testCanConvertToSource(int $id, BankAccountTypeContract $type, string $remoteId, int $customerId, string $lastFour, DateTime $createdAt, DateTime $updatedAt)
    {
        $nativePaymentMethod = (new BankAccountPaymentMethod())
            ->setId($id)
            ->setType($type)
            ->setRemoteId($remoteId)
            ->setCustomerId($customerId)
            ->setLastFour($lastFour)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt)
            ->setProviderName('fake');

        $woocommercePaymentToken = Mockery::namedMock(WC_Payment_Token_ECheck::class, WC_Payment_Token::class);

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
                                ->withArgs([BankAccountPaymentMethodAdapter::CREATED_AT_META_KEY, $nativePaymentMethod->getCreatedAt()->format('c')]);
        $woocommercePaymentToken->shouldReceive('update_meta_data')
                                ->once()
                                ->withArgs([BankAccountPaymentMethodAdapter::UPDATED_AT_META_KEY, $nativePaymentMethod->getUpdatedAt()->format('c')]);
        $woocommercePaymentToken->shouldReceive('update_meta_data')
                                ->once()
                                ->withArgs([BankAccountPaymentMethodAdapter::ACCOUNT_TYPE_META_KEY, $type->getName()]);

        $adapter = new BankAccountPaymentMethodAdapter($woocommercePaymentToken);

        $this->assertInstanceOf(WC_Payment_Token_ECheck::class, $adapter->convertToSource($nativePaymentMethod));
    }

    /** @see BankAccountPaymentMethodAdapterTest tests */
    public function providerBankAccountData() : array
    {
        return [
            'Checking account' => [123, new CheckingBankAccountType(), '001', 1, '1234', new DateTime('yesterday'), new DateTime('now')],
            'Savings account'  => [456, new SavingsBankAccountType(), '002', 2, '5678', new DateTime('yesterday'), new DateTime('now')],
        ];
    }
}
