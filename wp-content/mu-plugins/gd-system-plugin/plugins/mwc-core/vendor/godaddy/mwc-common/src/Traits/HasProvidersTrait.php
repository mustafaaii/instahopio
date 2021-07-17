<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use Exception;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract;

/**
 * A trait for objects that has providers.
 *
 * @since x.y.z
 */
trait HasProvidersTrait
{
    /** @var ProviderContract[] object providers */
    protected $providers = [];

    /**
     * Get the providers.
     *
     * @return ProviderContract[]
     */
    public function getProviders() : array
    {
        return $this->providers;
    }

    /**
     * Returns the requested provider, if found in the providers attribute.
     *
     * @param string $provider
     *
     * @return ProviderContract
     * @throws Exception
     */
    public function provider(string $provider) : ProviderContract
    {
        $foundProvider = ArrayHelper::get($this->providers, $provider);

        if (empty($foundProvider)) {
            throw new Exception("The given provider {$provider} is not found.");
        }

        return $foundProvider;
    }
}
