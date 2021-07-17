<?php

namespace GoDaddy\WordPress\MWC\Dashboard\Tests\Unit\Repositories;

use GoDaddy\WordPress\MWC\Common\Helpers\DeprecationHelper;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Common\Users\User;
use GoDaddy\WordPress\MWC\Dashboard\Repositories\UserRepository;
use Mockery;
use WP_Mock;

/**
 * @covers \GoDaddy\WordPress\MWC\Dashboard\Repositories\UserRepository
 */
final class UserRepositoryTest extends WPTestCase
{
    /**
     * Tests the getUserName() method.
     *
     * @param string $login
     * @param string $firstName
     * @param string $lastName
     * @param string $expected
     * @covers \GoDaddy\WordPress\MWC\Dashboard\Repositories\UserRepository::getUserName()
     * @dataProvider providerGetUserName
     */
    public function testGetUserName(string $login, string $firstName, string $lastName, string $expected)
    {
        WP_Mock::userFunction('metadata_exists')->andReturn(true);

        $user = $this->getMockBuilder(User::class)
                                    ->onlyMethods(['getHandle', 'getFullName'])
                                    ->getMock();
        $user->expects($this->any())
             ->method('getHandle')
             ->willReturn($login);
        $user->expects($this->any())
             ->method('getFullName')
             ->willReturn(trim(implode(' ', [$firstName, $lastName])));

        $this->mockStaticMethod(User::class, 'getCurrent')->andReturn($user);

        // suppress deprecated warning -- we know this method is deprecated, but we still want to test it
        $this->mockStaticMethod(DeprecationHelper::class, 'deprecatedFunction')->once()->andReturn('');

        $this->assertSame($expected, UserRepository::getUserName());
    }

    /**
     * Tests the getUserName() method with the user param.
     *
     * @param string $login
     * @param string $firstName
     * @param string $lastName
     * @param string $expected
     * @covers \GoDaddy\WordPress\MWC\Dashboard\Repositories\UserRepository::getUserName()
     * @dataProvider providerGetUserName
     */
    public function testGetUserNameWithParam(string $login, string $firstName, string $lastName, string $expected)
    {
        WP_Mock::userFunction('metadata_exists')->andReturn(true);

        $wpUser = Mockery::mock('\WP_User');
        $wpUser->ID = 100;

        $user = $this->getMockBuilder(User::class)
                     ->onlyMethods(['getHandle', 'getFullName'])
                     ->getMock();
        $user->expects($this->any())
             ->method('getHandle')
             ->willReturn($login);
        $user->expects($this->any())
             ->method('getFullName')
             ->willReturn(trim(implode(' ', [$firstName, $lastName])));

        $this->mockStaticMethod(User::class, 'getById')->andReturn($user);

        // suppress deprecated warning -- we know this method is deprecated, but we still want to test it
        $this->mockStaticMethod(DeprecationHelper::class, 'deprecatedFunction')->once()->andReturn('');

        $this->assertSame($expected, UserRepository::getUserName($wpUser));
    }

    /**
     * @see testGetUserName()
     * @see testGetUserNameWithParam()
     */
    public function providerGetUserName()
    {
        return [
            'full name' => ['johndoe', 'John', 'Doe', 'John Doe'],
            'first name only' => ['johndoe', 'John', '', 'John'],
            'last name only' => ['johndoe', '', 'Doe', 'Doe'],
            'login' => ['johndoe', '', '', 'johndoe'],
        ];
    }

    /**
     * Tests the getPasswordResetUrl() method.
     *
     * @covers \GoDaddy\WordPress\MWC\Dashboard\Repositories\UserRepository::getPasswordResetUrl()
     */
    public function testGetPasswordResetUrl()
    {
        $user = Mockery::mock( User::class);
        $user->shouldReceive('getPasswordResetUrl')
             ->andReturn('foo');

        $this->mockStaticMethod(User::class, 'getCurrent')->andReturn($user);

        // suppress deprecated warning -- we know this method is deprecated, but we still want to test it
        $this->mockStaticMethod(DeprecationHelper::class, 'deprecatedFunction')->once()->andReturn('');

        $this->assertSame('foo', UserRepository::getPasswordResetUrl());
    }

    /**
     * Tests the getPasswordResetUrl() method with the user param.
     *
     * @covers \GoDaddy\WordPress\MWC\Dashboard\Repositories\UserRepository::getPasswordResetUrl()
     */
    public function testGetPasswordResetUrlWithParam()
    {
        $wpUser = Mockery::mock('\WP_User');
        $wpUser->ID = 100;

        $user = Mockery::mock(User::class);
        $user->shouldReceive('getPasswordResetUrl')
             ->andReturn('foo');

        $this->mockStaticMethod(User::class, 'getById')
             ->with(100)
             ->andReturn($user);

        // suppress deprecated warning -- we know this method is deprecated, but we still want to test it
        $this->mockStaticMethod(DeprecationHelper::class, 'deprecatedFunction')->once()->andReturn('');

        $this->assertSame('foo', UserRepository::getPasswordResetUrl($wpUser));
    }

    /**
     * Tests the userOptedInForDashboardMessages() method.
     *
     * @param string $metaValue
     * @param bool $expected
     * @covers \GoDaddy\WordPress\MWC\Dashboard\Repositories\UserRepository::userOptedInForDashboardMessages()
     * @dataProvider providerUserOptedInForDashboardMessages
     */
    public function testUserOptedInForDashboardMessages(string $metaValue, bool $expected)
    {
        WP_Mock::userFunction('metadata_exists')->andReturn('' !== $metaValue);
        if ('' !== $metaValue) {
            WP_Mock::userFunction('get_user_meta')->andReturn($metaValue);
        }

        $user = Mockery::mock(User::class);
        $user->shouldReceive('getId')
              ->andReturn(1);

        $this->mockStaticMethod(User::class, 'getCurrent')->andReturn($user);

        $this->assertSame($expected, UserRepository::userOptedInForDashboardMessages());
    }

    /** @see testUserOptedInForDashboardMessages() */
    public function providerUserOptedInForDashboardMessages()
    {
        return [
            'opted in' => ['1', true],
            'opted out' => ['0', false],
            'default' => ['', false],
        ];
    }
}
