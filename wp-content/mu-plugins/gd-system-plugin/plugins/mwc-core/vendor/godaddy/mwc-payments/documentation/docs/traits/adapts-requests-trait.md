---
title: AdaptsRequestsTrait
---

Use this trait in classes or other traits that should have a `doAdaptedRequest` method available.

## Usage
```php
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Payments\Traits\AdaptsRequestsTrait;

class RequestHandler
{
    use AdaptsRequestsTrait;

    public function doAdaptedRequest($subject, DataSourceAdapterContract $adapter)
    {
        // use the adapter & subject to form an API request
    }
}
```