---
id: fulfillment-status
title: FulfillmentStatus
---

The `FulfillmentStatusContract` interface is a representation of a state of a fulfillable item or order. It extends `\GoDaddy\WordPress\MWC\Common\Contracts\HasLabelContract` and inherits its characteristics.

A fulfillable item or order can generally be in one of the following states:

* **Unfulfilled:** none of the items that need shipping are in a shipment for this order
* **Partially Fulfilled:** some of the items that need shipping are in a shipment for this order
* **Fulfilled:** all the items that need shipping are in a shipment for this order

## Usage

```php
use GoDaddy\WordPress\MWC\Common\Contracts\FulfillmentStatusContract;

public class FulfillmentSatusSample implements FulfillmentStatusContract {

    // ...
}
```