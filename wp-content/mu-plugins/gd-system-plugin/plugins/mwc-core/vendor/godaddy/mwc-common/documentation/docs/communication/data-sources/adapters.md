---
id: adapters
title: Adapters
---

Adapters take care of mapping data received from external sources into the format expected by the objects in the core package.

## DataSourceAdapterContract

All adapters must implement the `DataSourceAdapterContract` interface.

### Methods

#### convertFromSource

Maps the source data into data that can be used by the target object.

#### convertToSource

Gets the source data that was provided to the adapter when it was created.

## ExtensionAdapterContract

All adapters used to convert extension data should implement the `DataSourceAdapterContract` interface. This allows other components to work on extension data without worrying about its source.

### Methods

#### getType()

Gets the type of the extension from the data that the adapter currently holds.

```php
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\ExtensionAdapterContract;

function buildManagedExtension(ExtensionAdapterContract $adapter): AbstractExtension
{
    if (Theme::TYPE === $adapter->getType()) {
        return (new Theme())->setProperties($adapter->convertFromSource());
    }

    return (new Plugin())->setProperties($adapter->convertFromSource());
}
```

#### getImageUrls()

Gets the array of image URLs for the extension, formatted as `$identifier => $url`.

```php
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\ExtensionAdapterContract;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;

function renderExtensionImage(ExtensionAdapterContract $adapter)
{
    $hero_image_url = ArrayHelper::get($adapter->getImageUrls(), 'hero', 'placeholder-image.png');

    ?>
    <img src="<?php echo esc_url($hero_image_url); ?>" />
    <?php
}
```

## Available Adapters

### AddressAdapter

Converts address data between a WooCommerce address (represented by an array) and the native `Address` object.

The adapter can receive array data assuming either a WooCommerce address array, or an array with keys matching the `Address` object property names.

```php
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\AddressAdapter;
use \GoDaddy\WordPress\MWC\Common\Models\Address;

$addressData = []; // this should be an array of address data as defined in WooCommerce
$adapter = new AddressAdapter($addressData);

$adapter->convertFromSource(); // returns an `Address` object instance

$nativeAddress = new Address();
$adapter->convertToSource($nativeAddress); // returns an array as expected by WooCommerce
```

### CurrencyAmountAdapter

Converts a currency amount between a float as used by WooCommerce, and a native representation object `CurrencyAmount`.

```php
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\CurrencyAmountAdapter;
use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;

$adapter = new CurrencyAmountAdapter(123.45, 'USD');

$adapter->convertFromSource(); // returns a CurrencyAmount instance

$currencyAmount = (new CurrencyAmount())
    ->setAmount(54321)
    ->setCurrencyCode('USD');

$adapter->convertToSource($currencyAmount); // returns 543.21
```

### ExtensionAdapter

Converts data for a single extension returned by the [SkyVerge Extensions API](https://github.com/gdcorp-partners/skyverge-extensions-api) into an array that can be used to set the properties of an [extension object](/components/extension.md).

```php
use GoDaddy\WordPress\MWC\Common\DataSources\MWC\Adapters\ExtensionAdapter;

$adapter = new ExtensionAdapter($data);

return (new Plugin())->setProperties($adapter->convertFromSource());
```

### OrderAdapter

Converts a WooCommerce `WC_Order` object into a native `Order` object.

```php
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;

$woocommerceOrder = wc_get_order(123);
$adapter = new OrderAdapter($woocommerceOrder);
$adapter->convertFromSource(); // returns an instance of Order

$nativeOrder = new Order();
$adapter->convertToSource($nativeOrder); // returns an instance of WC_Order
```

The order adapter class can be extended to define a different order object to instantiate other than the native `Order` class:

```php
use GoDaddy\WordPress\MWC\Common\Models\Orders\Order;
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\Order\OrderAdapter;

class customOrder extends Order {}

class customAdapter extends OrderAdapter {
	protected $orderClass = customOrder::class;
}

$adapter = new customAdapter(wc_get_order(123));
$adapter->convertFromSource(); // returns an instance of customOrder
```

The order adapter uses more adapters for handling line items:

#### FeeItemAdapter 

Converts between `WC_Order_Item_Fee` WooCommerce order fee items and native [`FeeItem` objects](/models/orders/fee-item).

#### LineItemAdapter 

Converts between `WC_Order_Item_Product` WooCommerce order product items and native [`LineItem` objects](/models/orders/line-item).

#### ShippingItemAdapter

Converts between `WC_Order_Item_Shipping` WooCommerce order shipping items and native [`ShippingItem` objects](/models/orders/shipping-item).

#### TaxItemAdapter 

Converts between `WC_Order_Item_Tax` WooCommerce order tax items and native [`TaxItem` objects](/models/orders/tax-item). 

### WooCommerceExtensionAdapter

Converts data for a single extension returned by GoDaddy's partners API into an array of data that can be used to set the properties of an [extension object](/components/extension.md).

```php
use GoDaddy\WordPress\MWC\Common\DataSources\WooCommerce\Adapters\WooCommerceExtensionAdapter;

$adapter = new WooCommerceExtensionAdapter($data);

return (new Plugin())->setProperties($adapter->convertFromSource());
```
