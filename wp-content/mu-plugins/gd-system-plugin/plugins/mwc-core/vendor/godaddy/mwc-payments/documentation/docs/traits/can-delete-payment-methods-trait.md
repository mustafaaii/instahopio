---
title: CanDeletePaymentMethodsTrait
---

Use this trait in classes or other traits that should offer a `delete()` method for deleting payment methods via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Traits\CanDeletePaymentMethodsTrait;

class PaymentMethodsGateway extends AbstractGateway
{
    use CanDeletePaymentMethodsTrait;
}

$paymentMethod = new CardPaymentMethod();
$paymentMethod->setRemoteId('some-known-remote-id');

$paymentMethod = (new PaymentMethodsGateway())->delete($paymentMethod);
```