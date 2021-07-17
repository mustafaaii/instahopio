---
id: abstract-order-item 
title: AbstractOrderItem
---

The `AbstractOrderItem` model is a representation of an item in order.

## Get ID

Gets the order item ID.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

class Item extends AbstractOrderItem {
}

$item = new Item();
$orderItemId = $item->getId(); // returns order item (int) 
```

## Set ID

Sets the order item ID.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

class Item extends AbstractOrderItem {
}

$item = new Item();
$item->setId(123); // returns instance of self
$orderItemId = $item->getId(); // returns int(123)
```

## Get Total Amount

Gets the order item total amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

class Item extends AbstractOrderItem {
}

$item = new Item();
$itemTotalAmount = $item->getTotalAmount(); // returns the item `CurrencyAmount` object
```

## Set Total Amount

Sets the order item total amount as `CurrencyAmount` object.

```php
namespace GoDaddy\WordPress\MWC\Common\Models\Orders;

class Item extends AbstractOrderItem {
}

$item = new Item();

$totalAmount = new CurrencyAmount();
$totalAmount->setCurrencyCode('EUR');
$totalAmount->setAmount(20000); // in cents

$item->setTotalAmount($totalAmount); // returns instance of self
```