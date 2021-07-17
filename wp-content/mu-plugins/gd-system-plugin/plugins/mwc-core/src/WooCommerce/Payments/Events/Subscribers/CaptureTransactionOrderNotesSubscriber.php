<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Events\Subscribers;

use GoDaddy\WordPress\MWC\Core\Payments\Adapters\CaptureTransactionOrderNoteAdapter;

/**
 * Capture transaction order notes subscriber event.
 *
 * @since x.y.z
 */
class CaptureTransactionOrderNotesSubscriber extends TransactionOrderNotesSubscriber
{
    /** @var string overrides the transaction order notes adapter */
    protected $adapter = CaptureTransactionOrderNoteAdapter::class;
}
