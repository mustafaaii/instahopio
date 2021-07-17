---
title: CanIssuePaymentsTrait
---

Use this trait in classes or other traits that should offer a `pay()` method for issuing payment transactions via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

:::tip
The `pay()` method broadcasts a `PaymentTransactionEvent` event after the request
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\PaymentTransaction;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssuePaymentsTrait;

class TransactionsGateway extends AbstractGateway
{
    use CanIssuePaymentsTrait;
}

$transaction = new PaymentTransaction();

// set transaction properties

$transaction = (new TransactionsGateway())->pay($transaction);
```