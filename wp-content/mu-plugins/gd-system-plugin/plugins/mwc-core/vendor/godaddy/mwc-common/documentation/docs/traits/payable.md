---
id: payable
title: Payable
---

The `PayableTrait` trait can help an object to handle payments.

## Get the payment status

Use `getPaymentStatus` method to get the payment status.

```php
use GoDaddy\WordPress\MWC\Common\Traits\PayableTrait;

class MyClass
{
  use PayableTrait;

  public function __construct() {
    $this->paymentStatus = 'processing';
  }
}

$instance = new MyClass();
$instance->getPaymentStatus(); // returns 'processing'
```

## Set the payment status

Use `setPaymentStatus` method to set the payment status.

```php
use GoDaddy\WordPress\MWC\Common\Traits\PayableTrait;

class MyClass
{
  use PayableTrait;
}

$instance = new MyClass();
$instance->setPaymentStatus('processing'); // returns MyClass
$instance->getPaymentStatus(); // returns 'processing'
```