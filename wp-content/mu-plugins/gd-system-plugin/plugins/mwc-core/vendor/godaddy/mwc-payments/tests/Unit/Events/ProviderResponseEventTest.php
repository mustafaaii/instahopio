<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Events;

use GoDaddy\WordPress\MWC\Common\Http\Response;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Events\ProviderResponseEvent;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Events\ProviderResponseEvent
 */
class ProviderResponseEventTest extends WPTestCase
{
    /**
     * Tests that can get the response.
     *
     * @covers \GoDaddy\WordPress\MWC\Payments\Events\ProviderResponseEvent::getResponse
     */
    public function testCanGetResponse()
    {
        $response = new Response();

        $this->assertSame($response, (new ProviderResponseEvent($response))->getResponse());
    }
}
