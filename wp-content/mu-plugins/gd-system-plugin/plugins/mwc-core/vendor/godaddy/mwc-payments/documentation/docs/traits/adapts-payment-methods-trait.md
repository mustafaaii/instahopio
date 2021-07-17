---
title: AdaptsPaymentMethodsTrait
---

Use this trait in classes or other traits that should adapt `AbstractPaymentMethod` objects in some way, and need a `$paymentMethodAdapter` property available.

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Traits\AdaptsPaymentMethodsTrait;

class CustomerHandler
{
    use AdaptsPaymentMethodsTrait;

    public function __construct()
    {
        $this->paymentMethodAdapter = CustomAdapter::class;
    }
}
```