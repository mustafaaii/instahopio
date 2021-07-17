<?php

namespace GoDaddy\WordPress\MWC\Core\Payments\Adapters;

use Exception;
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\Statuses\ApprovedTransactionStatus;
use GoDaddy\WordPress\MWC\Payments\Payments;

/**
 * Transaction order note adapter.
 */
class TransactionOrderNoteAdapter implements DataSourceAdapterContract
{
    /** @var AbstractTransaction source */
    protected $source;

    /**
     * TransactionOrderNoteAdapter constructor.
     * @param AbstractTransaction $transaction
     */
    public function __construct(AbstractTransaction $transaction)
    {
        $this->source = $transaction;
    }

    /**
     * Converts from Data Source format.
     *
     * @since 1.0.0
     *
     * @return array
     * @throws Exception
     */
    public function convertFromSource() : array
    {
        $notes = [];

        $notes[] = sprintf('%s %s in the amount of %s %s.',
            Payments::getInstance()->provider($this->source->getProviderName())->getLabel(),
            $this->source->getType(),
            $this->getTotalAmount(),
            strtolower($this->source->getStatus() ? $this->source->getStatus()->getLabel() : '')
        );

        if ($transactionId = $this->source->getRemoteId()) {
            $notes[0] .= sprintf(' (Transaction ID %s)', $transactionId);
        }

        if (! $this->isTransactionApproved()) {
            if ($this->source->getResultCode()) {
                $notes[] = sprintf('Result: [%s] %s',
                    $this->source->getResultCode(),
                    $this->source->getResultMessage()
                );
            } else {
                $notes[] = 'Result: '.$this->source->getResultMessage();
            }
        }

        return $notes;
    }

    /**
     * Converts to Data Source format.
     *
     * @since 1.0.0
     *
     * @return AbstractTransaction
     */
    public function convertToSource() : AbstractTransaction
    {
        return $this->source;
    }

    /**
     * Gets the total amount converted to WooCommerce price standards.
     *
     * @since x.y.z
     *
     * @return string
     */
    protected function getTotalAmount() : string
    {
        $amount = $this->source->getTotalAmount();

        $convertedAmount = (new CurrencyAmountAdapter(0, ''))
            ->convertToSource($amount);

        return wc_price($convertedAmount, $amount->getCurrencyCode());
    }

    /**
     * Determines whether the transaction in this adapter is approved.
     *
     * @since x.y.z
     *
     * @return bool
     */
    protected function isTransactionApproved() : bool
    {
        return $this->source->getStatus() instanceof ApprovedTransactionStatus;
    }
}
