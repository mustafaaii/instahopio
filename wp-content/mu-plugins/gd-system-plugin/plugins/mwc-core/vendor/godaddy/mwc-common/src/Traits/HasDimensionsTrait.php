<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

/**
 * A trait to assign dimension properties to an object.
 *
 * @since x.y.z
 */
trait HasDimensionsTrait
{
    /** @var Dimensions */
    private $dimensions;

    /**
     * Gets the dimensions.
     *
     * @since x.y.z
     *
     * @return Dimensions
     */
    public function getDimensions() : Dimensions
    {
        return $this->dimensions;
    }

    /**
     * Sets the dimensions.
     *
     * @since x.y.z
     *
     * @param Dimensions $dimensions
     * @return self
     */
    public function setDimensions(Dimensions $dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }
}
