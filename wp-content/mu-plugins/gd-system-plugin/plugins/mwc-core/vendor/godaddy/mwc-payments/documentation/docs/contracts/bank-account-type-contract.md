---
title: BankAccountTypeContract
---

The `BankAccountTypeContract` interface is to be implemented by classes that represent a type of bank account such as "checking" or "savings."

:::caution
`BankAccountTypeContract` extends `HasLabelContract`, so implementing classes must also use the `HasLabelTrait` trait.
:::

## Usage
```php
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;
use GoDaddy\WordPress\MWC\Payments\Contracts\BankAccountTypeContract;

class JointCheckingBankAccountType implements BankAccountTypeContract
{
    use HasLabelTrait;

    public function __construct()
    {
        $this->label = 'Joint Checking';
        $this->name  = 'joint-checking';
    }
}
```
:::tip
* The class should be named with the pascal case version of the type's name, followed by the `BankAccountType` suffix
* The `$name` property's value should be a kebab-case version of the type
* The `$label` property's value should be the human-readable version of the type, meant for display
:::