<?php

namespace GoDaddy\WordPress\MWC\Core\Events\Subscribers;

use GoDaddy\WordPress\MWC\Common\Events\Contracts\EventContract;
use GoDaddy\WordPress\MWC\Common\Events\Contracts\SubscriberContract;

/**
 * Abstract order notes subscriber event.
 *
 * @since x.y.z
 */
abstract class AbstractOrderNotesSubscriber implements SubscriberContract
{
    /**
     * Gets a related WooCommerce order.
     *
     * @since x.y.z
     *
     * @param EventContract $event
     * @return \WC_Order
     */
    abstract protected function getOrder(EventContract $event) : \WC_Order;

    /**
     * Gets a list of order notes.
     *
     * @since x.y.z
     *
     * @param EventContract $event
     * @return string[]
     */
    abstract protected function getNotes(EventContract $event) : array;

    /**
     * Adds notes to a WooCommerce order.
     *
     * @since x.y.z
     *
     * @param \WC_Order $order WooCommerce order object
     * @param string[] $notes array of order notes
     * @return \WC_Order instance of the order with notes added
     */
    protected function addNotes(\WC_Order $order, array $notes = []) : \WC_Order
    {
        foreach ($notes as $note) {
            $order->add_order_note($note);
        }

        return $order;
    }

    /**
     * Determines whether the event should be handled.
     *
     * @see AbstractOrderNotesSubscriber::handle()
     *
     * @since x.y.z
     *
     * @param EventContract $event
     * @return bool
     */
    abstract protected function shouldHandle(EventContract $event) : bool;

    /**
     * Handles the event.
     *
     * @since x.y.z
     *
     * @param EventContract $event
     * @return \WC_Order|null
     */
    public function handle(EventContract $event)
    {
        if (! $this->shouldHandle($event)) {
            return null;
        }

        return $this->addNotes($this->getOrder($event), $this->getNotes($event));
    }
}
