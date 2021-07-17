---
title: HasCustomersTrait
---

Use this trait in provider classes that should handle `Customer` objects via a remote API, and need a `$customersGateway` property available.

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Traits\HasCustomersTrait;

class CustomProvider
{
    use HasCustomersTrait;

    public function __construct()
    {
        $this->customersGateway = CustomersGateway::class;
    }
}
```