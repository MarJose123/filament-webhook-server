# Changelog

All notable changes to `filament-webhook-server` will be documented in this file.

## 1.2.2 - 2023-07-06

### What's Changed

- Bump dependabot/fetch-metadata from 1.5.1 to 1.6.0 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/11
- Update WebhookHistory.php by @MarJose123 in https://github.com/MarJose123/filament-webhook-server/pull/12

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/1.2.1...1.2.2

## 1.2.1 - 2023-06-11

### What's Changed

- Bump dependabot/fetch-metadata from 1.3.6 to 1.4.0 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/7
- Bump dependabot/fetch-metadata from 1.4.0 to 1.5.1 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/8
- Add pages configurable by @a21ns1g4ts in https://github.com/MarJose123/filament-webhook-server/pull/9

### New Contributors

- @a21ns1g4ts made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/9

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/1.2.0...1.2.1

## 1.2.0 - 2023-04-14

### What's Changed

- feat: add custom webhook payload and support to Laravel 10 by @jeffersonGlemos in https://github.com/MarJose123/filament-webhook-server/pull/6

### New Contributors

- @jeffersonGlemos made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/6

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/1.1.0...1.2.0

## 1.1.0 - 2023-02-13

### Reminder

- Update your Config file to this latest

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
    'polling' => '10s',
    'webhook' => [
        'keep_history' => false,
    ],
];




```
- Republish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-webhook-server-migrations"




```
```bash
php artisan migrate




```
to be able to add the new table

### What's Changed

- Bump actions/dependency-review-action from 2 to 3 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/2
- Bump dependabot/fetch-metadata from 1.3.5 to 1.3.6 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/3
- Feat history log by @MarJose123 in https://github.com/MarJose123/filament-webhook-server/pull/4

### New Contributors

- @dependabot made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/2

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/1.0.1...1.1.0

## 1.0.1

## What's Changed

- dynamic carbon timezone and added updated_at on payload for summary by @MarJose123 in https://github.com/MarJose123/filament-webhook-server/pull/1

## New Contributors

- @MarJose123 made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/1

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/1.0.0...1.0.1

## 1.0.0

- initial release
