---
id: fulfillable
title: Fulfillable
---

The `FulfillableTrait` trait can help an object to handle fulfillment.

### Methods

#### Get the fulfillment status

Use `getFulfillmentStatus` method to get the fulfilment status of an [order](/models/orders/order) or [line item](/models/orders/line-item).

The fulfillment status can be `null`.

```php
use GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait;

class MyClass
{
  use FulfillableTrait;

  public function __construct() {
  
    $status = null; // an implementation of FulfillmentStatusContract
  
    $this->fulfillmentStatus = $status;
  }
}

$instance = new MyClass();
$instance->getFulfillmentStatus(); // returns an implementation of FulfillmentStatusContract
```

#### Set the fulfillment status

Use `setFulfillmentStatus` method to set the fulfilment status with an implementation of `FulfillmentStatusContract`.

```php
use GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait;

class MyClass
{
    use FulfillableTrait;
}

$instance = new MyClass();
$instance->setFulfillmentStatus($status); // returns MyClass
$instance->getFulfillmentStatus(); // returns an implementation of FulfillmentStatusContract
```

#### Set the needs shipping property

Use `setNeedsShipping` method to set this flag. This property is used to differentiate objects that must be shipped (like physical goods) from others that do not require it (virtual).

```php
use GoDaddy\WordPress\MWC\Common\Traits\FulfillableTrait;

class MyClass
{
  use FulfillableTrait;
}

$instance = new MyClass(); 
$instance->setNeedsShipping(true); // returns MyClass
$instance->getNeedsShipping(); // returns true
```
