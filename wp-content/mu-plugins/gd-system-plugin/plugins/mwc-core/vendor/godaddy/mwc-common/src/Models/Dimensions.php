<?php

namespace GoDaddy\WordPress\MWC\Common\Models;

use GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait;

/**
 * An object representation of dimensions.
 *
 * @since x.y.z
 */
class Dimensions
{
    use HasUnitOfMeasurementTrait;

    /** @var float the height */
    private $height;

    /** @var float the width */
    private $width;

    /** @var float the length */
    private $length;

    /**
     * Gets the height value.
     *
     * @since x.y.z
     *
     * @return float
     */
    public function getHeight() : float
    {
        return is_float($this->height) ? $this->height : 0;
    }

    /**
     * Sets the height value.
     *
     * @since x.y.z
     *
     * @param float $value
     * @return self
     */
    public function setHeight(float $value) : Dimensions
    {
        $this->height = $value;

        return $this;
    }

    /**
     * Gets the width value.
     *
     * @since x.y.z
     *
     * @return float
     */
    public function getWidth() : float
    {
        return is_float($this->width) ? $this->width : 0;
    }

    /**
     * Sets the width value.
     *
     * @since x.y.z
     *
     * @param float $value
     * @return self
     */
    public function setWidth(float $value) : Dimensions
    {
        $this->width = $value;

        return $this;
    }

    /**
     * Gets the length value.
     *
     * @since x.y.z
     *
     * @return float
     */
    public function getLength() : float
    {
        return is_float($this->length) ? $this->length : 0;
    }

    /**
     * Sets the length value.
     *
     * @since x.y.z
     *
     * @param float $value
     * @return self
     */
    public function setLength(float $value) : Dimensions
    {
        $this->length = $value;

        return $this;
    }
}
