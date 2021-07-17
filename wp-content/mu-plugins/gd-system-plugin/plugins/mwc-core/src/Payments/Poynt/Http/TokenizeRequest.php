<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Poynt\Http;

use Exception;

/**
 * The representation of a tokenize business request.
 *
 * @since x.y.z
 */
class TokenizeRequest extends AbstractBusinessRequest
{
    /**
     * TokenizeRequest constructor.
     *
     * @since x.y.z
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setMethod('POST');
        $this->route = 'cards/tokenize';

        parent::__construct();
    }
}
