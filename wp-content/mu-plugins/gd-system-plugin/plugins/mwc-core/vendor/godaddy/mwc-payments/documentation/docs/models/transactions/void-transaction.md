---
title: VoidTransaction
---

The `VoidTransaction` class represents a void transaction for a previous payment.

## Usage
```php
use GoDaddy\WordPress\MWC\Common\Model\CurrencyAmount;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction;
use GoDaddy\WordPress\MWC\Payments\Payments;

$amount = new CurrencyAmount();
$amount->setCurrencyCode('USD');
$amount->setAmount(100);

$transaction = new VoidTransaction();
$transaction->setTotalAmount($amount)
    ->setReason('Accidental purchase');

$transaction = Payments::getInstance()->provider('some-provider')->transactions()->void($transaction);

// maybe store the resulting transaction's state
```