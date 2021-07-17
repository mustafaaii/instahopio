<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Integrations\Contracts;

/**
 * Interface IntegrationContract
 *
 * @since x.y.z
 */
interface IntegrationContract
{
    /**
     * Get the integration's supports.
     *
     * @return string[]
     */
    public function getSupports() : array;
}
