---
id: billable
title: Billable
---

The `Billable` trait represents objects that are billable.

## Get the billing address

Use `getBillingAddress` method to get the billing address.

```php
use GoDaddy\WordPress\MWC\Common\Traits\BillableTrait;
use GoDaddy\WordPress\MWC\Common\Models\Address;

class MyClass
{
  use BillableTrait;

  public function __construct() {
    $this->setBillingAddress((new Address())->setPostalCode(12345));
  }
}

$instance = new MyClass();
$instance->getBillingAddress(); // returns an Address instance
```

## Set the billing address

Use `setBillingAddress` method to set the billing address.

```php
use GoDaddy\WordPress\MWC\Common\Traits\BillableTrait;

class MyClass
{
  use BillableTrait;
}

$instance = new MyClass();
$instance->setBillingAddress((new Address())->setPostalCode(12345)); // returns $instance
$instance->getBillingAddress()->getPostalCode(); // returns 12345
```
