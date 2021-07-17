---
title: AdaptsCustomersTrait
---

Use this trait in classes or other traits that should adapt `Customer` objects in some way, and need a `$customerAdapter` property available.

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Traits\AdaptsCustomersTrait;

class CustomerHandler
{
    use AdaptsCustomersTrait;

    public function __construct()
    {
        $this->customerAdapter = CustomAdapter::class;
    }
}
```