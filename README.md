# Send webhooks from your filament apps

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marjose123/filament-webhook-server.svg?style=flat-square)](https://packagist.org/packages/marjose123/filament-webhook-server)
[![Total Downloads](https://img.shields.io/packagist/dt/marjose123/filament-webhook-server.svg?style=flat-square)](https://packagist.org/packages/marjose123/filament-webhook-server)

![image1](https://github.com/MarJose123/filament-webhook-server/blob/main/.art/filament-webhook-server1.png)

This package provides a Filament page that you can send webhook server . You'll find installation instructions and full documentation on [spatie/laravel-webhook-server](https://github.com/spatie/laravel-webhook-server).

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

This is the contents of the published config file:

```php
return [
    /*
     *  Models that you want to be part of the webhooks options
     */
    'models' => [
        \App\Models\User::class,
    ],
    /*
     */
    'polling' => '10s'
];

```

## Usage
> 1. Add the models that you want to be part of the webhook
> 2. This package will automatically register the `Webhook-Server`. You'll be able to see it when you visit your Filament admin panel.

## Customising the polling interval

You can customise the polling interval for the `Webhook-Server` by publishing the configuration file and updating the `polling` value.

## Webhook payload Structure
```
[
  {
    "event": "created",  // <== Type of Event
    "module": "Testing", // <== Module that were the event happend
    "triggered_at": "2023-01-18T05:07:37.748031Z", // <== Based on the Date and time the Event happen
    "data": { // <== Actual information depending on what you selected "Summary or All"
      "id": 34,
      "created_at": "2023-01-18T05:07:37.000000Z"
    }
  }
]
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
