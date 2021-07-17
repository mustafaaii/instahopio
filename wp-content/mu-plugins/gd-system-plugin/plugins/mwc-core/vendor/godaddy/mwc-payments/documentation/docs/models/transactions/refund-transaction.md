---
title: RefundTransaction
---

The `RefundTransaction` class represents a refund transaction for a previous payment.

## Properties
In addition to the properties inherited from [`AbstractTransaction`](abstract-transaction):

|Property|Description|
|-|-|
|`reason`|The reason for the refund|

## Usage
```php
use GoDaddy\WordPress\MWC\Common\Model\CurrencyAmount;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction;
use GoDaddy\WordPress\MWC\Payments\Payments;

$amount = new CurrencyAmount();
$amount->setCurrencyCode('USD');
$amount->setAmount(100);

$transaction = new RefundTransaction();
$transaction->setTotalAmount($amount)
    ->setReason('Broken in transit');

$transaction = Payments::getInstance()->provider('some-provider')->transactions()->refund($transaction);

// maybe store the resulting transaction's state
```