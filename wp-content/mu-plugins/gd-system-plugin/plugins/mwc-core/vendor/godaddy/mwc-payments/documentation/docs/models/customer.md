---
title: Customer
---

The `Customer` class represents a single customer in an online store.

## Properties
|Property|Description|
|-|-|
|`id`| The database ID for the method, if stored|
|`paymentMethods`|The stored payment methods that belong to this customer|
|`remoteId`|An ID that's used in a remote system, such as a payment gateway provider|
|`user`|The user object that's associated with this customer|

:::info
* This classes uses the `BillableTrait` & `ShippableTrait` traits to provide the `billingAddress` & `shippingAddress` properties and their getters & setters
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Common\Users\User;
use GoDaddy\WordPress\MWC\Payments\Models\Customer;

$currentUser = User::getCurrent();
$customer = new Customer();
$customer->setUser($currentUser);

// maybe attach the customer to a transaction or send it via an API request
```