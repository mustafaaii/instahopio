---
title: AbstractGateway
---

This class can be extended by classes that represent a "gateway" to a remote API and need methods for that communication.

:::tip
The various `Can{Thing}Trait` traits can be used to easily add known payment processing functionality to concrete gateways
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssuePaymentsTrait;
use GoDaddy\WordPress\MWC\Payments\Traits\CanIssueRefundsTrait;

class CustomTransactionsGateway extends AbstractGateway
{
    use CanIssuePaymentsTrait;
    use CanIssueRefundsTrait;
}
```