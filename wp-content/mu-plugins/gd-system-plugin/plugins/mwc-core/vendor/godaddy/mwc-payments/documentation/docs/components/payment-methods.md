---
title: Payment Methods
---

Payment methods represent a customer's payment details, such as credit card or bank account. They can be attached to [transactions](transactions), or stored on their own if the implementing system supports saving payment methods for later use.

## Available types
| Class                | Description                                              |
|----------------------|----------------------------------------------------------|
| `BankAccountPaymentMethod`|A customer's bank account details|
| `CardPaymentMethod`|A customer's credit or debit card details|

:::note
Payment methods do not hold sensitive data such as card numbers. They only contain data used for display like expiration date, type, etc... and optionally a `remoteId` if used with an external system
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;

class PaymentProcessor
{
    public function processPayment(PaymentTransaction $transaction)
    {
        $transaction->setPaymentMethod(new CardPaymentMethod());

        // do some processing, like making an API request and updating the $transaction object with the response

        return $transaction;
    }

    
}
```

## Creating new types
New payment method types can be added by [extending `AbstractPaymentMethod`](../models/payment-methods/abstract-payment-method).

:::note
Before adding new types to this library, consider whether it will be useful for other projects. If a new type is needed that's specific to your project, consider only defining it in that project.
:::