<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Gateways;

use Exception;
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Http\Request;
use GoDaddy\WordPress\MWC\Common\Tests\Helpers\Http\RequestHelper;
use GoDaddy\WordPress\MWC\Common\Tests\WPTestCase;
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Traits\AdaptsRequestsTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway
 */
class AbstractGatewayTest extends WPTestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\AdaptsRequestsTrait::doAdaptedRequest()
     *
     * @throws Exception
     */
    public function testCanDoAdaptedRequest()
    {
        $adapterMock = $this->getMockDataSourceAdapterContract();
        $gatewayMock = $this->getMockForAbstractClass(AbstractGateway::class);

        RequestHelper::fake();

        $gatewayMock->doAdaptedRequest('Subject', $adapterMock);

        RequestHelper::assertSent();
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway::doRequest()
     *
     * @throws Exception
     */
    public function testCanDoRequest()
    {
        $gatewayMock = $this->getMockForAbstractClass(AbstractGateway::class);

        RequestHelper::fake();

        $request = (new Request())
            ->setMethod('GET')
            ->body(['key' => 'value']);

        $gatewayMock->doRequest($request);

        RequestHelper::assertSent();
    }

    /**
     * Gets an instance of a class that implements the data source adapter.
     *
     * @see testCanDoAdaptedRequest
     *
     * @return DataSourceAdapterContract
     */
    private function getMockDataSourceAdapterContract() : DataSourceAdapterContract
    {
        return new class implements DataSourceAdapterContract {

            public function convertFromSource() : Request
            {
                return new Request();
            }

            public function convertToSource() : array
            {
                return ['source'];
            }
        };
    }
}
