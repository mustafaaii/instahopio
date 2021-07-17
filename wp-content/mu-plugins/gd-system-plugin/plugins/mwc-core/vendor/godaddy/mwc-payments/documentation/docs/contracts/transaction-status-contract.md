---
title: TransactionStatusContract
---

The `TransactionStatusContract` interface is to be implemented by classes that represent the status of a transaction, such as "Approved" or "Declined."

:::caution
`TransactionStatusContract` extends `HasLabelContract`, so implementing classes must also use the `HasLabelTrait` trait.
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Payments\Contracts\TransactionStatusContract;

class InReviewTransactionStatus implements TransactionStatusContract
{
    use HasLabelTrait;

    public function __construct()
    {
        $this->label = 'In Review';
        $this->name  = 'in-review';
    }
}
```
:::tip
* The class should be named with the pascal case version of the brand's name, followed by the `TransactionStatus` suffix
* The `$name` property's value should be a kebab-case version of the status
* The `$label` property's value should be the human-readable version of the status, meant for display
:::