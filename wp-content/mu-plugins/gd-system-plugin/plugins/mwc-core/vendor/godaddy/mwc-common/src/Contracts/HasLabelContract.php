<?php

namespace GoDaddy\WordPress\MWC\Common\Contracts;

/**
 * Label contract interface.
 *
 * @since x.y.z
 */
interface HasLabelContract
{
    /**
     * Gets the label name.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Gets the label value.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getLabel() : string;

    /**
     * Sets the label name.
     *
     * @since x.y.z
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name);

    /**
     * Sets the label value.
     *
     * @since x.y.z
     *
     * @param string $label
     * @return self
     */
    public function setLabel(string $label);
}
