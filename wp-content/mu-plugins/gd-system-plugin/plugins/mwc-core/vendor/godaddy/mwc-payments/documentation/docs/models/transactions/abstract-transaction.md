---
title: AbstractTransaction
---

The `AbstractTransaction` class represents any financial transaction and holds its data, to be passed around by implementing code for API requests or storage.

## Properties
|Property|Description|
|-|-|
|`createdAt` | The date at which the transaction was created|
|`customer`| A [customer](../customer) associated with the transaction|
|`notes`| Any notes that are part of the transaction|
|`order`| An [order](https://upgraded-lamp-d562c70b.pages.github.io/models/orders/order) associated with the transaction|
|`paymentMethod`|A [payment method](../payment-methods/abstract-payment-method) associated with the transaction|
|`providerName`|The name of the provider associated with the transaction, such as a payment provider|
|`remoteId`|An ID that's used in a remote system, such as a payment gateway provider|
|`remoteParentId`|An ID that's used to reference the transaction's parent in a remote system, such as a payment gateway provider|
|`resultCode`|A code provided by an external system to represent the result of this transaction|
|`resultMessage`|A message provided by an external system to represent the result of this transaction|
|`source`|A free-form field to represent the source of the transaction if needed|
|`status`|The general [status](../../contracts/transaction-status-contract) of the transaction|
|`totalAmount`|The total [currency amount](https://upgraded-lamp-d562c70b.pages.github.io/models/currency-amount) for the transaction|
|`type`|The type name for the transaction, to be used internally in implementing code|
|`updatedAt`|The date at which the transaction was last updated|

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\AbstractTransaction;

class CustomTransaction extends AbstractTransaction
{
    protected $type = 'custom';
}
```
:::tip
* The class should be named with the pascal case version of the type's name, followed by the `Transaction` suffix
* The `$type` property's value should be a kebab-case version of the type
:::