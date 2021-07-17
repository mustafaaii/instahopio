---
title: CanIssueCapturesTrait
---

Use this trait in classes or other traits that should offer a `capture()` method for capturing transactions via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

:::tip
The `capture()` method broadcasts a `CaptureTransactionEvent` event after the request
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssueCapturesTrait;

class TransactionsGateway extends AbstractGateway
{
    use CanIssueCapturesTrait;
}

$transaction = new CaptureTransaction();

// set transaction properties

$transaction = (new TransactionsGateway())->capture($transaction);
```