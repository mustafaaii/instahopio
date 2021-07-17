<?php

namespace GoDaddy\WordPress\MWC\Common\Providers;

use BadMethodCallException;
use GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract;
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;

/**
 * Abstract provider class.
 *
 * @since x.y.z
 */
abstract class AbstractProvider implements ProviderContract
{
    use HasLabelTrait;

    /** @var string provider description */
    protected $description;

    /**
     * Throws an exception when an unsupported feature method is accessed.
     *
     * @since x.y.z
     *
     * @param string $name
     * @param array $arguments
     * @throws BadMethodCallException
     */
    public function __call($name, $arguments)
    {
        throw new BadMethodCallException(sprintf('Call to undefined method %s', __CLASS__.'::'.$name));
    }

    /**
     * Gets the description.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description.
     *
     * @since x.y.z
     *
     * @param string $value
     * @return self
     */
    public function setDescription(string $value) : AbstractProvider
    {
        $this->description = $value;

        return $this;
    }
}
