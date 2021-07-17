---
title: CanIssueRefundsTrait
---

Use this trait in classes or other traits that should offer a `refund()` method for issuing refund transactions via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

:::tip
The `refund()` method broadcasts a `RefundTransactionEvent` event after the request
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\RefundTransaction;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssueRefundsTrait;

class TransactionsGateway extends AbstractGateway
{
    use CanIssueRefundsTrait;
}

$transaction = new RefundTransaction();

// set transaction properties

$transaction = (new TransactionsGateway())->refund($transaction);
```