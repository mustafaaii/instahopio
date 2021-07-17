---
id: fee-item
title: FeeItem
---

The `FeeItem` model is a representation of a fee item in an order.

## Get Tax Amount

Gets the fee item total tax amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;
$item = new FeeItem();
$item->getTaxAmount(); // returns the tax amount as `CurrencyAmount` object
```

## Set Tax Amount

Sets the fee item total tax amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;
$item = new FeeItem();
$taxAmount = new CurrencyAmount();
$taxAmount->setCurrencyCode('EUR');
$taxAmount->setAmount(20000); // in cents
$item->setTaxAmount($taxAmount); // returns instance of self
```
