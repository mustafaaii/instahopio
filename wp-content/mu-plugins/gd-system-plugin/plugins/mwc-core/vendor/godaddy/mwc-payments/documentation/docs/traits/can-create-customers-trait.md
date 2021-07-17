---
title: CanCreateCustomersTrait
---

Use this trait in classes or other traits that should offer a `create()` method for creating customers via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Traits\CanCreateCustomersTrait;

class CustomersGateway extends AbstractGateway
{
    use CanCreateCustomersTrait;
}

$customer = (new CustomersGateway())->create(new Customer());

// store the updated customer object
```