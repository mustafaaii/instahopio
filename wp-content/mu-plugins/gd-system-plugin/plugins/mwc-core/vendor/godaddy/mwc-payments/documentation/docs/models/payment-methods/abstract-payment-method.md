---
title: AbstractPaymentMethod
---

The `AbstractPaymentMethod` class represents a customer's payment method, like a credit card or bank account.

## Properties
|Property|Description|
|-|-|
|`createdAt` | The date at which the payment method was created|
|`customerId`| The ID for the method's customer record|
|`id`| The database ID for the method, if stored|
|`label`| The label for the method, to be displayed on the frontend|
|`providerName`|The name of the provider associated with the transaction, such as a payment provider|
|`remoteId`|An ID that's used in a remote system, such as a payment gateway provider. This is commonly referred to as a payment token|
|`updatedAt`|The date at which the transaction was last updated|

:::info
* This classes uses the `BillableTrait` trait to provide the `billingAddress` property and its getter & setter
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\AbstractPaymentMethod;

class CustomPaymentMethod extends AbstractPaymentMethod
{
    // custom properties or methods
}
```
:::tip
* The class should be named with the pascal-case version of the method type's name, followed by the `PaymentMethod` suffix
:::