<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests\Unit\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Http\Response;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Traits\CanGetPaymentMethodsTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanGetPaymentMethodsTrait
 */
class CanGetPaymentMethodsTraitTest extends TestCase
{
    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanGetPaymentMethodsTrait::get()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanDoGetRequest()
    {
        $response = $this->getTraitMock(['foo' => 'bar'], ['success'])->get(['foo' => 'bar']);

        $this->assertInstanceOf(AbstractPaymentMethod::class, $response);
        $this->assertEquals(['success'], $response->body);
    }

    /**
     * @covers \GoDaddy\WordPress\MWC\Payments\Traits\CanGetPaymentMethodsTrait::getAll()
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanDoGetAllRequest()
    {
        $response = $this->getTraitMock(['foo' => 'bar'], [['success']])->getAll(['foo' => 'bar']);

        $this->assertIsArray($response);
        $this->assertEquals(['success'], $response[0]->body);
    }

    /**
     * @param array $params
     * @param array $response
     *
     * @return CanGetPaymentMethodsTrait|MockObject
     * @throws ReflectionException
     */
    private function getTraitMock(array $params, array $response)
    {
        $mock = $this->getMockForTrait(
            CanGetPaymentMethodsTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['doRequest']
        );

        $mock->method('doRequest')
            ->with('GET', $params)
            ->willReturn((new Response())->body($response));

        $paymentMethodAdapterMock = $this->getPaymentAdapterMock($response);

        TestHelpers::getInaccessibleProperty(get_class($mock), 'paymentMethodAdapter')->setValue($mock, get_class($paymentMethodAdapterMock));

        return $mock;
    }

    /**
     * @param mixed $body
     *
     * @return object
     */
    private function getPaymentAdapterMock($body)
    {
        return new class($body) {

            protected $source;

            public function __construct($body)
            {
                $this->source = $body;
            }

            public function convertFromSource() : AbstractPaymentMethod
            {
                $body = $this->source;

                return new class($body) extends AbstractPaymentMethod {
                    public $body;

                    public function __construct($body)
                    {
                        $this->body = $body;
                    }
                };
            }
        };
    }
}
