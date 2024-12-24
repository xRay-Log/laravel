# xRay for Laravel

Laravel integration for xRay. This package provides an easy way to debug and log your Laravel application.

<p align="center">
<a href="https://github.com/XRay-Log/laravel/actions"><img src="https://github.com/XRay-Log/laravel/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/xray-log/laravel"><img src="https://img.shields.io/packagist/dt/xray-log/laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/xray-log/laravel"><img src="https://img.shields.io/packagist/v/xray-log/laravel" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/xray-log/laravel"><img src="https://img.shields.io/packagist/l/xray-log/laravel" alt="License"></a>
</p>

## Installation

You can install the package via composer:

```bash
composer require xray-log/laravel
```

## Usage

Here are some examples of how to use xRay Logger:

```php
// Direct logging (defaults to info)
xRay('Info message');

// Different log levels
xRay('Error message')->error();
xRay('Warning message')->warning();
xRay('Debug message')->debug();

// With exit
xRay('Debug this')->exit();
```

## License

The XRay Log Laravel Package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
