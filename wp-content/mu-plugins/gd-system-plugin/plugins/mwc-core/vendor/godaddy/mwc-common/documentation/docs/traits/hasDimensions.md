---
id: has-dimensions
title: HasDimensions
---

The `HasDimensions` trait allows objects to have a [`Dimensions`](/models/weight) property.

## Set Dimensions

Sets the object's dimensions.

```php
use GoDaddy\WordPress\MWC\Common\Models\Dimensions;
use GoDaddy\WordPress\MWC\Common\Traits\HasDimensionsTrait;

class FooProduct
{
  use HasDimensionsTrait;
}

$dimensions = new Dimensions();
$product = new FooProduct();
$product->setDimensions($dimensions); // sets the Dimensions instance and returns self
```

## Get Dimensions

Gets the object's dimensions.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasDimensionsTrait;

class FooProduct
{
  use HasDimensionsTrait;
}

$product = new FooProduct();
$product->getDimensions(); // gets an instance of Dimensions
```