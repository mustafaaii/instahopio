---
id: line-item 
title: LineItem
---

The `LineItem` model is a representation of a line item in an order. Like `Orders`, `LineItem` objects can be [fulfilled](/traits/fulfillable).

### Traits

The line item uses the following traits, and thus inherits the associated methods:

- [Fulfillable](/traits/fulfillable)

### Methods

#### Get Quantity

Gets the line item quantity.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

$item = new LineItem();
$item->getQuantity(); // returns quantity (int|float) 
```

#### Set Quantity

Sets the line item quantity. This can be an integer or float.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

$item = new LineItem();
$item->setQuantity(2); // returns instance of self
$item->getQuantity(); // returns int(2)
```

#### Get Tax Amount

Gets the line item total tax amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

$item = new LineItem();
$item->getTaxAmount(); // returns the tax amount as `CurrencyAmount` object
```

#### Set Tax Amount

Sets the line item total tax amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

$item = new LineItem();

$taxAmount = new CurrencyAmount();
$taxAmount->setCurrencyCode('EUR');
$taxAmount->setAmount(20000); // in cents

$item->setTaxAmount($taxAmount); // returns instance of self
```
