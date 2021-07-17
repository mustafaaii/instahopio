---
id: has-unit-of-measurement
title: HasUnitOfMeasurement
---

The `HasUnitOfMeasurementTrait` trait provides methods to get the unit of measurement from objects using it.

## Get unit of measurement

Returns the unit property.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait;

class MyClass
{
  use HasUnitOfMeasurementTrait;

  public function __construct() {
     $this->setUnitOfMeasurement('weight');
  }
}

$instance = new MyClass();
$instance->getUnitOfMeasurement(); // returns 'weight'
```

## Set unit of measurement

Sets the unit property.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasUnitOfMeasurementTrait;

class MyClass
{
  use HasUnitOfMeasurementTrait;
}

$instance = new MyClass();
$instance->setUnitOfMeasurement('weight'); // returns MyClass
$instance->getUnitOfMeasurement(); // returns 'weight'
```
