---
id: abstract-provider
title: AbstractProvider
---

An `AbstractProvider` provides a common building-block for representing an external provider by providing name, label, and description properties.

The abstract class implements the [`ProviderContract` interface](/providers/provider-contract).

### Usage

```php
 
use GoDaddy\WordPress\MWC\Common\Providers\AbstractProvider;

class ConcreteProvider extends AbstractProvider 
{
    // ...
}

$provider = new ConcreteProvider();
```

### Methods

The abstract defines the following public methods and inherits additional method definitions from the [HasLabelContract](/contracts/has-label) interface.

#### Get the name of the provider

```php
$provider->getName(); // returns the name of the provider
```

#### Set the name for the provider

```php
$provider->setName('name'); // returns an instance of self
$provider->getName(); // returns 'name'
```

#### Get the label of the provider

```php
$provider->getLabel(); // returns the description of the provider
```

#### Set the label for the provider

```php
$provider->setLabel('label'); // returns an instance of self
$provider->getLabel(); // returns 'label'
```

#### Get the description of the provider

```php
$provider->getDescription(); // returns the description of the provider
```

#### Set the description for the provider

```php
$provider->setDescription('description'); // returns an instance of self
$provider->getDescription(); // returns 'description'
```
