<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

/**
 * A trait to handle units of measurement.
 *
 * @since x.y.z
 */
trait HasUnitOfMeasurementTrait
{
    /** @var string|null */
    protected $unit;

    /**
     * Gets the unit of measurement.
     *
     * @since x.y.x
     *
     * @return string
     */
    public function getUnitOfMeasurement() : string
    {
        return is_string($this->unit) ? $this->unit : '';
    }

    /**
     * Sets the unit of measurement.
     *
     * @since x.y.z
     *
     * @param string $unit
     * @return self
     */
    public function setUnitOfMeasurement(string $unit)
    {
        $this->unit = $unit;

        return $this;
    }
}
