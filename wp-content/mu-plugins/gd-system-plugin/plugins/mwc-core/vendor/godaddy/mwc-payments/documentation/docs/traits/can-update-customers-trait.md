---
title: CanUpdateCustomersTrait
---

Use this trait in classes or other traits that should offer a `update()` method for updating customers via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Traits\CanUpdateCustomersTrait;

class CustomersGateway extends AbstractGateway
{
    use CanUpdateCustomersTrait;
}

$customer = (new CustomersGateway())->update(new Customer());

// store the updated customer object
```