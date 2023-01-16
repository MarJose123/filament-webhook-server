# Send webhooks from your filament apps

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marjose123/filament-webhook-server.svg?style=flat-square)](https://packagist.org/packages/marjose123/filament-webhook-server)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/marjose123/filament-webhook-server/run-tests?label=tests)](https://github.com/marjose123/filament-webhook-server/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/marjose123/filament-webhook-server/Check%20&%20fix%20styling?label=code%20style)](https://github.com/marjose123/filament-webhook-server/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/marjose123/filament-webhook-server.svg?style=flat-square)](https://packagist.org/packages/marjose123/filament-webhook-server)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require marjose123/filament-webhook-server
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-webhook-server-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-webhook-server-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-webhook-server-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filament-webhook-server = new Marjose123\FilamentWebhookServer();
echo $filament-webhook-server->echoPhrase('Hello, Marjose123!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marjose](https://github.com/MarJose123)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
