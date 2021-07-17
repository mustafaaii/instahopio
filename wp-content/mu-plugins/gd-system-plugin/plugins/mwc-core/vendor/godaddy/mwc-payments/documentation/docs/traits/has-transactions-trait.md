---
title: HasTransactionsTrait
---

Use this trait in provider classes that should handle `AbstractTransaction` objects via a remote API, and need a `$transactionsGateway` property & `transactions()` method available.

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Traits\HasTransactionsTrait;

class CustomProvider
{
    use HasTransactionsTrait;

    public function __construct()
    {
        $this->transactionsGateway = TransactionsGateway::class;
    }
}
```