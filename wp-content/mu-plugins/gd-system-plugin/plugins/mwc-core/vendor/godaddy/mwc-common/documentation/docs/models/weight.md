---
id: weight
title: Weight
---

The `Weight` model is a representation of a weight amount.

## Get value

Gets the weight amount.

```php
use GoDaddy\WordPress\MWC\Common\Models\Weight;

$weight = new Weight();
$weight->getValue(); // returns the current weight amount from the instance
```

## Set value

Sets the weight amount.

```php
use GoDaddy\WordPress\MWC\Common\Models\Weight;

$weight = new Weight();
$weight->setValue(100); // returns instance of self
$weight->getValue(); // returns 100
```

## Unit of measurement

`Weight` uses the `HasUnitOfMeasurementTrait`, which means that `getUnitOfMeasurement()` and `setUnitOfMeasurement()` are available methods for this class.

```php
use GoDaddy\WordPress\MWC\Common\Models\Weight;

$weight = new Weight();
$weight->setUnitOfMeasurement('kg'); // returns instance of self
$weight->getUnitOfMeasurement(); // returns 'kg'
```