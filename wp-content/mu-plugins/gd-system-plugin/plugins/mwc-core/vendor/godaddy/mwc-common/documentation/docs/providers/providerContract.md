---
id: provider-contract
title: ProviderContract
---

A `ProviderContract` is an object that implements services for a given API, usually by using traits that expose dedicated methods for each one of those services.

### Usage

```php
use GoDaddy\WordPress\MWC\Common\Providers\Contracts\ProviderContract;

class ConcreteProvider implements ProviderContract 
{
    // ...
}
```

### Methods

The contract defines the following public methods and inherits additional method definitions from the [HasLabelContract](/contracts/has-label) interface.

#### Get the description of the provider

```php
$provider->getDescription(); // returns the description of the provider
```

#### Set the description for the provider

```php
$provider->setDescription('description'); // returns an instance of self
$provider->getDescription(); // returns 'description'
```
