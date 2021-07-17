---
title: CardBrandContract
---

The `CardBrandContract` interface is to be implemented by classes that represent a brand of credit card such as "Visa" or "Mastercard."

:::caution
`CardBrandContract` extends `HasLabelContract`, so implementing classes must also use the `HasLabelTrait` trait.
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Payments\Contracts\CardBrandContract;

class SupperClubCardBrand implements CardBrandContract
{
    use HasLabelTrait;

    public function __construct()
    {
        $this->label = 'Supper Club';
        $this->name  = 'supper-club';
    }
}
```
:::tip
* The class should be named with the pascal case version of the brand's name, followed by the `CardBrand` suffix
* The `$name` property's value should be a kebab-case version of the brand
* The `$label` property's value should be the human-readable version of the brand, meant for display
:::