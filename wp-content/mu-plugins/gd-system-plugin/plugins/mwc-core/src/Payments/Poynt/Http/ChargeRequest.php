<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Poynt\Http;

use Exception;

/**
 * The representation of a charge business request.
 *
 * @since x.y.z
 */
class ChargeRequest extends AbstractBusinessRequest
{
    /**
     * ChargeRequest constructor.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setMethod('POST');
        $this->route = 'cards/tokenize/charge';

        parent::__construct();
    }
}
