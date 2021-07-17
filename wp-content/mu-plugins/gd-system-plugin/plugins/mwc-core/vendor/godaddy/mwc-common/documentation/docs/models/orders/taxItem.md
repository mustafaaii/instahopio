---
id: tax-item
title: TaxItem
---

The `TaxItem` model is a representation of a tax item in an order.

## Get Rate

Gets the tax item rate.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;
$item = new TaxItem();
$item->getRate(); // returns the tax rate (float)
```

## Set Tax Rate

Sets the tax item rate.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;
$item = new TaxItem();
$item->setRate(2.5); // returns instance of self
```