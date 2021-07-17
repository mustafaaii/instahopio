<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

/**
 * A trait to handle labels.
 *
 * @since x.y.z
 */
trait HasLabelTrait
{
    /** @var string|null */
    protected $name;

    /** @var string|null */
    protected $label;

    /**
     * Gets the label name.
     *
     * @since x.y.x
     *
     * @return string
     */
    public function getName() : string
    {
        return is_string($this->name) ? $this->name : '';
    }

    /**
     * Gets the label value.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getLabel() : string
    {
        return is_string($this->label) ? $this->label : '';
    }

    /**
     * Sets the label name.
     *
     * @since x.y.z
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Sets the label value.
     *
     * @since x.y.z
     *
     * @param string $label
     * @return self
     */
    public function setLabel(string $label)
    {
        $this->label = $label;

        return $this;
    }
}
