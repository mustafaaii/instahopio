---
title: CanIssueVoidsTrait
---

Use this trait in classes or other traits that should offer a `void()` method for issuing void transactions via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

:::tip
The `void()` method broadcasts a `VoidTransactionEvent` event after the request
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\VoidTransaction;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssueVoidsTrait;

class TransactionsGateway extends AbstractGateway
{
    use CanIssueVoidsTrait;
}

$transaction = new VoidTransaction();

// set transaction properties

$transaction = (new TransactionsGateway())->void($transaction);
```