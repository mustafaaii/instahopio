<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use GoDaddy\WordPress\MWC\Common\Models\Weight;

/**
 * A trait to assign a weight property to an object.
 *
 * @since x.y.z
 */
trait HasWeightTrait
{
    /** @var Weight */
    private $weight;

    /**
     * Gets the weight.
     *
     * @since x.y.z
     *
     * @return Weight
     */
    public function getWeight() : Weight
    {
        return $this->weight;
    }

    /**
     * Sets the weight.
     *
     * @since x.y.z
     *
     * @param Weight $weight
     * @return self
     */
    public function setWeight(Weight $weight)
    {
        $this->weight = $weight;

        return $this;
    }
}
