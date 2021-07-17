<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Poynt\Http;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;

/**
 * The base request for all business-specific API requests.
 *
 * @since x.y.z
 */
abstract class AbstractBusinessRequest extends Request
{
    /** @var string the business ID */
    protected $businessId;

    /**
     * AbstractBusinessRequest constructor.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this
            ->setBusinessId()
            ->setRoute();

        parent::__construct();
    }

    /**
     * Sets the business ID.
     *
     * @since x.y.z
     *
     * @return AbstractBusinessRequest
     *
     * @throws Exception
     */
    protected function setBusinessId() : AbstractBusinessRequest
    {
        $this->businessId = Configuration::get('payments.poynt.businessId');

        return $this;
    }

    /**
     * Sets the route.
     *
     * @since x.y.z
     *
     * @return self
     */
    protected function setRoute() : AbstractBusinessRequest
    {
        $this->route = sprintf('businesses/%s/%s', $this->businessId, $this->route);

        return $this;
    }
}
