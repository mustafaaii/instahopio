---
id: shippable
title: Shippable
---

The `Shippable` trait represents objects that are shippable.

## Get the shipping address

Use `getShippingAddress` method to get the shipping address.

```php
use GoDaddy\WordPress\MWC\Common\Traits\ShippableTrait;
use GoDaddy\WordPress\MWC\Common\Models\Address;

class MyClass
{
  use ShippableTrait;

  public function __construct() {
    $this->billingAddress = (new Address())->setPostalCode(12345);
  }
}

$instance = new MyClass();
$instance->getShippingAddress(); // returns an Address instance
```

## Set the shipping address

Use `setShippingAddress` method to set the shipping address.

```php
use GoDaddy\WordPress\MWC\Common\Traits\ShippableTrait;

class MyClass
{
  use ShippableTrait;
}

$instance = new MyClass();
$instance->setShippingAddress((new Address())->setPostalCode(12345)); // returns $instance
$instance->getShippingAddress()->getPostalCode(); // returns 12345
```
