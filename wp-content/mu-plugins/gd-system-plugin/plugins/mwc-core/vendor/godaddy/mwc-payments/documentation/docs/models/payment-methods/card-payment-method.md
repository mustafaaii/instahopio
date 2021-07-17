---
title: CardPaymentMethod
---

The `CardPaymentMethod` class represents a customer's card payment method, such as a Visa card.

## Properties
|Property|Description|
|-|-|
|`bin` | The card's bank identification number, i.e. first six digits of the card number|
|`brand` | The card's brand identifier, such as Visa or Mastercard|
|`expirationMonth` | Month of expiration|
|`expirationYear` | Year of expiration, in 4 digits|
|`lastFour` | The last four digits of the card number|

## Usage
```php
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\CardPaymentMethod;
use GoDaddy\WordPress\MWC\Payments\Models\PaymentMethods\Cards\Brands\VisaCardBrand;

$paymentMethod = new CardPaymentMethod();
$paymentMethod->setBrand(new VisaCardBrand())
    ->setLastFour('1234')
    ->setExpirationMonth('02')
    ->setExpirationYear('2022')
    ->setRemoteId('some-remote-id');

// maybe interact with an external API using the remote ID, or store the method
```