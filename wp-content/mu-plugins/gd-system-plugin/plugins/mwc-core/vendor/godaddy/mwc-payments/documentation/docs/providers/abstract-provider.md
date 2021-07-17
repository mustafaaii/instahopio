---
title: AbstractProvider
---

Implementations can use this class to define a payment provider and enable the API functionality that it supports using the available traits.

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Providers\AbstractProvider;
use GoDaddy\WordPress\MWC\Payments\Traits\HasTransactionsTrait;

class CustomProvider extends AbstractProvider
{
    use HasTransactionsTrait; // import traits to gain supported functionality, like creating transactions

    protected $description = 'This is an awesome provider';

    protected $name = 'custom';

    protected $label = 'Custom';
}
```
:::tip
* The class should be named with the pascal case version of the provider's name, followed by the `Provider` suffix
* The `$name` property's value should be a kebab-case version of the name
* The `$label` property's value should be a human-readable version of the name, for display
:::