# This package is a wrapper for the SynergyCP. It's primarly built to integrate with Snipe It inventory management system.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/knownhost/synergycp.svg?style=flat-square)](https://packagist.org/packages/knownhost/synergycp)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/knownhost/synergycp/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/knownhost/synergycp/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/knownhost/synergycp/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/knownhost/synergycp/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/knownhost/synergycp.svg?style=flat-square)](https://packagist.org/packages/knownhost/synergycp)

## Installation

You can install the package via composer:

```bash
composer require knownhost/synergycp
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="synergycp-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="synergycp-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$sCP = new Knownhost\SCP();
echo $sCP->echoPhrase('Hello, Knownhost!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Andrew Murray](https://github.com/andrewmurray2)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
