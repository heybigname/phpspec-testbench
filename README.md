# PHPSpec Testbench

![PXL icon](http://www.pixelindustries.com/img/logo.svg)

## Overview
PHPSpec Testbench is built upon [benconstable/phpspec-laravel](https://github.com/BenConstable/phpspec-laravel) and will bridge the gap between PHPSpec and [orchestral/testbench](https://github.com/orchestral/testbench) by using the Laravel Application fixture as provided by testbench instead of having to need a fully prepared Laravel Application for yourself. With the `phpspec-testbench` extension, you can spec your Laravel Packages easily, whilst keeping all of the functionality that the `phpspec-laravel` extension brings.

## Requirements
PHPSpec Testbench is built with Laravel 5 in mind and thus depends on the corresponding L5 compatible versions from `phpspec-laravel` and `orchestral-testbench`. **PHPSpec Testbench does not work with Laravel 4**.

## Installation
Simply pull in this package via composer:

`composer require pixelindustries/phpspec-testbench --dev`

## Usage
In your `phpspec.yml` file, simply add the `Pixelindustries\PhpspecTestbench\LaravelExtension` to the `extension` array:


```yaml
extensions:
  - Pixelindustries\PhpspecTestbench\LaravelExtension
```

**Please note that this extension should not be used in _addition_ to the `phpspec-laravel` extension, but rather as a replacement.**

After the above configuration, simply write your specs the way you are used to, utilizing `phpspec-laravel`'s functionality in the process.

### Custom application class

Should you need to do custom routines for the application bootstrapping, such as making sure your own developed service providers are registered, you can utilize the `class_name` setting for the `laravel_extension` key in your `phpspec.yml` file:

```yaml
laravel_extension:
  app_classname: Acme\Tests\MyCustomApp
```

This gives you the flexibility to implement your own routines in the `getEnvironmentSetUp()` method as provided by [testbench](http://orchestraplatform.com/docs/latest/components/testbench#overriding-setup-method). For example:

```php
<?php

namespace Acme\Tests;

use Pixelindustries\PhpspecTestbench\App as TestApp;

class MyCustomApp extends TestApp
{
  protected function getEnvironmentSetUp($app)
  {
      // Custom bootstrapping
  }
}

```

Please note that your custom class **must** extend the `Pixelindustries\PhpspecTestbench\App` class.
