---
id: order
title: Order
---

The native `Order` item represents an eCommerce order.

To create an order instance, use the following namespace:

```php
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;

$order = new Order();
```

### Traits

The order uses the following traits, and thus inherits the associated methods:

- [Billable](/traits/billable)
- [Fulfillable](/traits/fulfillable)
- [Payable](/traits/payable)
- [Shippable](/traits/shippable)

### Methods

The order object uses the following _private_ properties, which can be accessed via corresponding public getters and setters methods, for reading from and writing to, respectively.

The setters will always return the current instance of the order.

| Parameter            | Type                                           | Description                                                  |
|----------------------|------------------------------------------------|--------------------------------------------------------------|
| id                   | int                                            | A unique numerical identifier                                |
| number               | string                                         | A unique string identifier                                   |
| status               | OrderStatusContract                            | An object implementing the `OrderStatusContract` interface   |
| createdAt            | DateTime                                       | The date when the order was created                          |
| updatedAt            | DateTime                                       | The date when the order was last updated                     |
| customerId           | int                                            | The identifier of the customer associated with the order     |
| customerIpAddress    | string                                         | The IP address of the customer associated with the order     |
| lineItems            | [LineItem[]](/models/orders/line-item)         | An array of line items associated with the order             |
| lineAmount           | [CurrencyAmount](/models/currency-amount)      | The order line items amount, as an object                    |
| shippingItems        | [ShippingItem[]](/models/orders/shipping-item) | An array of shipping items associated with the order         |
| shippingAmount       | [CurrencyAmount](/models/currency-amount)      | The order shipping items amount, as an object                |
| feeItems             | [FeeItem[]](/models/orders/fee-item)           | An array of fee items associated with the order              |
| feeAmount            | [CurrencyAmount](/models/currency-amount)      | The order fee items amount, as an object                     |
| taxItems             | [TaxItem[]](/models/orders/tax-item)           | An array of tax items associated with the order              |
| taxAmount            | [CurrencyAmount](/models/currency-amount)      | The order tax items amount, as an object                     |
| totalAmount          | [CurrencyAmount](/models/currency-amount)      | The order total, as an object                                |

For example:

```php
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;

$order = new Order();
$order->setId(123); // sets the order ID to `123` and returns the instance of `$order`
$order->getId(); // will return the order ID `123`
$order->setCreatedAt(new \DateTime('now')); // sets the created date to "now" and returns the `$order` instance

// ... and so forth with other getters/setters for the properties listed above
```
