<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\Events\Subscribers;

use GoDaddy\WordPress\MWC\Common\Events\Contracts\EventContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Core\Events\Subscribers\AbstractOrderNotesSubscriber;
use GoDaddy\WordPress\MWC\Core\Payments\Adapters\TransactionOrderNoteAdapter;
use GoDaddy\WordPress\MWC\Payments\Events\AbstractTransactionEvent;
use WC_Order;

/**
 * Transaction order notes subscriber event.
 *
 * @since x.y.z
 */
class TransactionOrderNotesSubscriber extends AbstractOrderNotesSubscriber
{
    /** @var string the transaction order notes adapter class name */
    protected $adapter = TransactionOrderNoteAdapter::class;

    /**
     * Gets a WooCommerce order object.
     *
     * @since x.y.z
     *
     * @param EventContract $event
     * @return WC_Order
     * @throws BaseException
     */
    protected function getOrder(EventContract $event) : WC_Order
    {
        if ($this->shouldHandle($event)) {
            $order = wc_get_order($event->getTransaction()->getOrder()->getId());

            if (! $order instanceof WC_Order) {
                throw new BaseException('Order not found');
            }

            return $order;
        }

        throw new BaseException('Invalid transaction event');
    }

    /**
     * Gets order notes.
     *
     * @since x.y.z
     *
     * @param EventContract $event
     * @return string[]
     */
    protected function getNotes(EventContract $event) : array
    {
        return (new $this->adapter($event->getTransaction()))->convertFromSource();
    }

    /**
     * Determines whether it should handle the event.
     *
     * @since x.y.z
     *
     * @param EventContract $event
     * @return bool
     */
    protected function shouldHandle(EventContract $event) : bool
    {
        return $event instanceof AbstractTransactionEvent;
    }
}
