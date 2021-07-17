---
title: CanDeleteCustomersTrait
---

Use this trait in classes or other traits that should offer a `delete()` method for deleting customers via a remote API.

:::caution
Classes that use this trait must have a `doAdaptedRequest()` defined or extend a class that does, such as `AbstractGateway`
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Gateways\AbstractGateway;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;
use GoDaddy\WordPress\MWC\Payments\Traits\CanDeleteCustomersTrait;

class CustomersGateway extends AbstractGateway
{
    use CanDeleteCustomersTrait;
}

$customer = new Customer();
$customer->setRemoteId('some-known-remote-id');

$customer = (new CustomersGateway())->delete($customer);
```