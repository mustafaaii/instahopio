---
title: CanCreatePaymentMethodsTrait
---

Use this trait in classes or other traits that should offer a `create()` method for creating payment methods via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Traits\CanCreatePaymentMethodsTrait;

class PaymentMethodsGateway extends AbstractGateway
{
    use CanCreatePaymentMethodsTrait;
}

$customer = (new PaymentMethodsGateway())->create(new CardPaymentMethod());

// store the updated payment method object object
```