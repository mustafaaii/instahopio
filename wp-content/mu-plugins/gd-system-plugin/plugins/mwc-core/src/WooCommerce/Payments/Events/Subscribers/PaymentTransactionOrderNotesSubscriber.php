<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Events\Subscribers;

use GoDaddy\WordPress\MWC\Core\Payments\Adapters\PaymentTransactionOrderNoteAdapter;

/**
 * Payment transaction order notes subscriber event.
 *
 * @since x.y.z
 */
class PaymentTransactionOrderNotesSubscriber extends TransactionOrderNotesSubscriber
{
    /** @var string overrides the transaction order notes adapter */
    protected $adapter = PaymentTransactionOrderNoteAdapter::class;
}
