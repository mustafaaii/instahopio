<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Events\Subscribers;

use GoDaddy\WordPress\MWC\Core\Payments\Adapters\RefundTransactionOrderNoteAdapter;

/**
 * Refund transaction order notes subscriber event.
 *
 * @since x.y.z
 */
class RefundTransactionOrderNotesSubscriber extends TransactionOrderNotesSubscriber
{
    /** @var string overrides the transaction order notes adapter */
    protected $adapter = RefundTransactionOrderNoteAdapter::class;
}
