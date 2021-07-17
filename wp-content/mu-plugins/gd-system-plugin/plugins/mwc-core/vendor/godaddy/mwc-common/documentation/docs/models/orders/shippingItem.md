---
id: shipping-item
title: ShippingItem
---

The `ShippingItem` model is a representation of a shipping item in an order.

## Get Tax Amount

Gets the shipping item total tax amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;
$item = new ShippingItem();
$item->getTaxAmount(); // returns the tax amount as `CurrencyAmount` object
```

## Set Tax Amount

Sets the shipping item total tax amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;
$item = new ShippingItem();
$taxAmount = new CurrencyAmount();
$taxAmount->setCurrencyCode('EUR');
$taxAmount->setAmount(20000); // in cents
$item->setTaxAmount($taxAmount); // returns instance of self
```