<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Poynt\Http;

use Exception;

/**
 * Refund transaction API request.
 *
 * @since x.y.z
 */
class RefundTransactionRequest extends AbstractTransactionRequest
{
    /** @var string request method */
    public $method = 'POST';
}
