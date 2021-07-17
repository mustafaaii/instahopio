---
id: has-weight
title: HasWeight
---

The `HasWeight` trait allows objects to implement a weight property that uses [`Weight`](/models/weight).

## Set Weight

Sets the object's weight.

```php
use GoDaddy\WordPress\MWC\Common\Models\Weight;
use GoDaddy\WordPress\MWC\Common\Traits\HasWeightTrait;

class FooProduct
{
  use HasWeightTrait;
}

$weight = new Weight();
$product = new FooProduct();
$product->setWeight($weight); // sets the Weight instance and returns self
```

## Get Weight

Gets the object's weight.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasWeightTrait;

class FooProduct
{
  use HasWeightTrait;
}

$product = new FooProduct();
$product->getWeight(); // gets an instance of Weight
```