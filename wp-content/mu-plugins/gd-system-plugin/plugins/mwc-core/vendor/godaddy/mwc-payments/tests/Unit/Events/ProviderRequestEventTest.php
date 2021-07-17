<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Http\Request;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Events\ProviderRequestEvent;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\ProviderRequestEvent
 */
class ProviderRequestEventTest extends WPTestCase
{
    /**
     * Tests that can get the request.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\ProviderRequestEvent::getRequest
     */
    public function testCanGetRequest()
    {
        $request = new Request();

        $this->assertSame($request, (new ProviderRequestEvent($request))->getRequest());
    }
}
