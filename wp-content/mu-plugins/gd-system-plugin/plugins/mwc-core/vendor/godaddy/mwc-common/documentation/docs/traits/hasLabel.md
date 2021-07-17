---
id: has-label
title: HasLabel
---

The `HasLabelTrait` trait can be used in objects that implement `HasLabelContract` interfaces to provide methods to get the label name and value.

## Get Name

Returns the name property.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;

class MyClass
{
  use HasLabelTrait;

  public function __construct() {
     $this->name = 'my-name';
  }
}

$instance = new MyClass();
$instance->getName(); // returns 'my-name'
```

## Get Label

Returns the label property.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;

class MyClass
{
  use HasLabelTrait;

  public function __construct() {
    $this->label = 'my-label';
  }
}

$instance = new MyClass();
$instance->getLabel(); // returns 'my-name'
```

## Set Name

Sets the name property.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;

class MyClass
{
  use HasLabelTrait;
}

$instance = new MyClass();
$instance->setName('my-name'); // returns MyClass
$instance->getName(); // returns 'my-name'
```

## Set Label

Sets the label property.

```php
use GoDaddy\WordPress\MWC\Common\Traits\HasLabelTrait;

class MyClass
{
  use HasLabelTrait;
}

$instance = new MyClass();
$instance->setLabel('my-label'); // returns MyClass
$instance->setLabel(); // returns 'my-label'
```
