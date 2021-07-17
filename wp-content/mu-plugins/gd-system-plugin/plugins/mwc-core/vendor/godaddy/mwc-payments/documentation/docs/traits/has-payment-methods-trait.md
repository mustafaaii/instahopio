---
title: HasPaymentMethodsTrait
---

Use this trait in provider classes that should handle `AbstractPaymentMethod` objects via a remote API, and need a `$paymentMethodsGateway` property available.

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Traits\HasPaymentMethodsTrait;

class CustomProvider
{
    use HasPaymentMethodsTrait;

    public function __construct()
    {
        $this->paymentMethodsGateway = PaymentMethodsGateway::class;
    }
}
```