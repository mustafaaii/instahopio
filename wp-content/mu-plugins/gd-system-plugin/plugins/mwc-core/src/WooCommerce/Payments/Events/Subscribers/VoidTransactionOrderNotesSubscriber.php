<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Events\Subscribers;

use GoDaddy\WordPress\MWC\Core\Payments\Adapters\VoidTransactionOrderNoteAdapter;

/**
 * Void transaction order notes subscriber event.
 *
 * @since x.y.z
 */
class VoidTransactionOrderNotesSubscriber extends TransactionOrderNotesSubscriber
{
    /** @var string overrides the transaction order notes adapter */
    protected $adapter = VoidTransactionOrderNoteAdapter::class;
}
