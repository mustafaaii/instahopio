---
id: currency-amount
title: CurrencyAmount
---

The `CurrencyAmount` model is a representation of an amount in a currency.

## Get Amount

Gets the amount.

```php
namespace GoDaddy\WordPress\MWC\Common\Models;

$currencyAmount = new CurrencyAmount();
$currencyAmount->getAmount(); // returns the current amount from the instance
```

## Set Amount

Sets the amount.

```php
namespace GoDaddy\WordPress\MWC\Common\Models;

$currencyAmount = new CurrencyAmount();
$currencyAmount->setAmount(100); // returns instance of self
$currencyAmount->getAmount(); // returns 100
```

## Get Currency Code

Gets the currency code. This should be a three-letter code following the Unicode CLDR standard.

```php
namespace GoDaddy\WordPress\MWC\Common\Models;

$currencyAmount = new CurrencyAmount();
$currencyAmount->getCurrencyCode(); // returns the current currency code from the instance
```

## Set Currency Code

Sets the currency code. This should be a three-letter code following the Unicode CLDR standard.

```php
namespace GoDaddy\WordPress\MWC\Common\Models;

$currencyAmount = new CurrencyAmount();
$currencyAmount->setCurrencyCode('EUR'); // returns instance of self
$currencyAmount->getCurrencyCode(); // returns 'EUR'
```