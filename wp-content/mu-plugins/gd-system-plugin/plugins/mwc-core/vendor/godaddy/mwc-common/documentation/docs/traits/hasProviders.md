---
id: has-providers
title: HasProvidersTrait
---

The `HasProvidersTrait` trait can be used in objects that require providers classes.

Each provider has to implement `Providers\Contracts\ProviderContract` interface

## Get Providers

Returns the list of providers registered for the object.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasProvidersTrait;

class MyClass
{
  use HasProvidersTrait;

  public function __construct() {
     $this->providers = [
        'poynt' => new Poynt(),
     ];
  }
}

$instance = new MyClass();
$providers = $instance->getProviders();
```

## Provider

Gets specific provider by passing its key, it throws an exception error if provider not registered.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasProvidersTrait;

class MyClass
{
  use HasProvidersTrait;

  public function __construct() {
     $this->providers = [
        'poynt' => new Poynt(),
     ];
  }
}

$instance = new MyClass();
$provider = $instance->provider('poynt');
```