---
id: dimensions
title: Dimensions
---

The `Dimensions` model is a representation of a dimension object with height, length and width.

## Get height

Gets the height.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

$dimensions = new Dimensions();
$dimensions->getHeight(); // returns the current height from the instance
```

## Set height

Sets the height value.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

$dimensions = new Dimensions();
$dimensions->setHeight(100); // returns instance of self
$dimensions->getHeight(); // returns 100
```

## Get length

Gets the length.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

$dimensions = new Dimensions();
$dimensions->getLength(); // returns the current length from the instance
```

## Set length

Sets the length value.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

$dimensions = new Dimensions();
$dimensions->setLength(100); // returns instance of self
$dimensions->getLength(); // returns 100
```

## Get width

Gets the width.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

$dimensions = new Dimensions();
$dimensions->getWidth(); // returns the current width from the instance
```

## Set width

Sets the width value.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

$dimensions = new Dimensions();
$dimensions->setWidth(100); // returns instance of self
$dimensions->getWidth(); // returns 100
```

## Unit of measurement

`Dimensions` uses the `HasUnitOfMeasurementTrait`, which means that `getUnitOfMeasurement()` and `setUnitOfMeasurement()` are available methods for this class.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;

$dimensions = new Dimensions();
$dimensions->setUnitOfMeasurement('cm'); // returns instance of self
$dimensions->getUnitOfMeasurement(); // returns 'cm'
```