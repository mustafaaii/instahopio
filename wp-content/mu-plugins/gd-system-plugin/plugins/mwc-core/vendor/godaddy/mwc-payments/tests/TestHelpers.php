<?php

namespace GoDaddy\WordPress\MWC\Payments\Tests;

use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Http\Request;
use GoDaddy\WordPress\MWC\Common\Tests\TestHelpers as CoreTestHelpers;
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use ReflectionClass;
use ReflectionException;

/**
 * Test helpers
 */
class TestHelpers extends CoreTestHelpers
{
    /**
     * Allows for setting private or protected properties in a class.
     *
     * @param $instance
     * @param $class
     * @param $property
     * @param $value
     *
     * @throws ReflectionException
     */
    public static function setInaccessibleProperty($instance, $class, $property, $value)
    {
        $class = new ReflectionClass($class);

        $property = $class->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($instance, $value);
    }

    /**
     * Gets a gateway class instance that extends the abstract gateway.
     *
     * @return AbstractGateway
     */
    public static function getMockGateway() : AbstractGateway
    {
        return new class extends AbstractGateway {
            public function getRequest() : Request
            {
                return new Request();
            }
        };
    }

    /**
     * Gets data source adapter mock
     *
     * @return DataSourceAdapterContract
     */
    public static function getDataSourceAdapterContractMock() : DataSourceAdapterContract
    {
        return new class implements DataSourceAdapterContract {

            public function convertFromSource() : array
            {
                return [];
            }

            public function convertToSource() : array
            {
                return [];
            }
        };
    }
}
