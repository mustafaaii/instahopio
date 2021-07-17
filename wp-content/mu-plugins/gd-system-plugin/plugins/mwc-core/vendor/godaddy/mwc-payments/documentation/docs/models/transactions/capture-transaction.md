---
title: CaptureTransaction
---

The `CaptureTransaction` class represents a capture transaction for a previously authorized [`PaymentTransaction`](payment-transaction).

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Models\Transactions\CaptureTransaction;
use GoDaddy\WordPress\MWC\Payments\Payments;

$transaction = new CaptureTransaction();
$transaction->setRemoteParentId('some-payment-remote-id');

$transaction = Payments::getInstance()->provider('some-provider')->transactions()->capture($transaction);

// maybe store the resulting transaction's state
```