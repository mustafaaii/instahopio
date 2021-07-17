---
title: PaymentTransaction
---

The `PaymentTransaction` class represents a single financial payment.

## Properties
In addition to the properties inherited from [`AbstractTransaction`](abstract-transaction):

|Property|Description|
|-|-|
|`amount`|The base amount of the payment, not including tip amount or any other amounts. `totalAmount` represents the full amount|
|`authOnly`|Whether the payment should be only authorized or authorized and captured|
|`tipAmount`|The tip amount, separate from the payment amount|

## Usage
```php
use GoDaddy\WordPress\MWC\Common\Model\CurrencyAmount;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;
use GoDaddy\WordPress\MWC\Payments\Payments;

$amount = new CurrencyAmount();
$amount->setCurrencyCode('USD');
$amount->setAmount(100);

$transaction = new PaymentTransaction();
$transaction->setTotalAmount($amount);

$transaction = Payments::getInstance()->provider('some-provider')->transactions()->pay($transaction);

// maybe store the resulting transaction's state
```