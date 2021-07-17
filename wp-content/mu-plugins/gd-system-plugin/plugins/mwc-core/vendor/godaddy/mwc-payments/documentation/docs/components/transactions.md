---
title: Transactions
---

Transactions can represent any financial transaction that takes place during payment processing.

## Available types
| Class                | Description                                              |
|----------------------|----------------------------------------------------------|
| `CaptureTransaction` | A transaction to capture a previously authorized payment |
| `PaymentTransaction` | A transaction that represents a payment                  |
| `RefundTransaction`  | A transaction to refund a previous payment               |
| `VoidTransaction`    | A transaction to void a previously authorized payment    |

Each of these classes can be used to define the transaction's data for storage or before passing to an adapter to form an API request.

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;

class PaymentProcessor
{
    public function processPayment(PaymentTransaction $transaction)
    {
        // do some processing, like making an API request and updating the $transaction object with the response

        return $transaction;
    }
}
```

## Creating new types
New types can be added by [extending `AbstractTransaction`](../models/transactions/abstract-transaction).

:::note
Before adding new transaction types to this library, consider whether it will be useful for other projects. If a new type is needed that's specific to your project, consider only defining it in that project.
:::