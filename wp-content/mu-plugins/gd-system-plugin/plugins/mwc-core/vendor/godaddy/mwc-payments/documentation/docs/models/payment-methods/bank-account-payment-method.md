---
title: BankAccountPaymentMethod
---

The `BankAccountPaymentMethod` class represents a customer's bank account payment method.

## Properties
|Property|Description|
|-|-|
|`lastFour` | The last four digits of the account number|
|`type`| The bank account type, such as savings or checking|

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccountPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\BankAccounts\Types\CheckingBankAccountType;

$paymentMethod = new BankAccountPaymentMethod();
$paymentMethod->setType(new CheckingBankAccountType())
    ->setLastFour('1234')
    ->setRemoteId('some-remote-id');

// maybe interact with an external API using the remote ID, or store the method
```