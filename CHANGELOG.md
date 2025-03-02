# Changelog

All notable changes to `filament-webhook-server` will be documented in this file.

## 2.1.7 - 2025-03-02

### What's Changed

* Bump dependabot/fetch-metadata from 2.2.0 to 2.3.0 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/37
* Add ability to add Cluster to pages by @AidanLaycock in https://github.com/MarJose123/filament-webhook-server/pull/40

### New Contributors

* @AidanLaycock made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/40

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.1.6...2.1.7

## 2.1.6 - 2024-11-14

### What's Changed

* Fix models register by @a21ns1g4ts in https://github.com/MarJose123/filament-webhook-server/pull/35

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.1.5...2.1.6

## 2.1.5 - 2024-11-07

### What's Changed

* Secure Global Observer Registration for Models by @a21ns1g4ts in https://github.com/MarJose123/filament-webhook-server/pull/33

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.1.4...2.1.5

## 2.1.4 - 2024-09-22

### What's Changed

* Add pt translations by @a21ns1g4ts in https://github.com/MarJose123/filament-webhook-server/pull/32

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.1.3...2.1.4

## 2.1.3 - 2024-07-28

### What's Changed

* Bump dependabot/fetch-metadata from 2.1.0 to 2.2.0 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/28
* Remove icon composer package by @Poseidon281 in https://github.com/MarJose123/filament-webhook-server/pull/31

### New Contributors

* @Poseidon281 made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/31

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.1.2...2.1.3

## 2.1.2 - 2024-06-26

### What's Changed

* Update composer.json by @MarJose123 in https://github.com/MarJose123/filament-webhook-server/pull/27

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.1.1...2.1.2

## 2.1.1 - 2024-05-22

### What's Changed

* Add webhook api feature by @0xCyyy3000 in https://github.com/MarJose123/filament-webhook-server/pull/26

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.1.0...2.1.1

## 2.1.0 - 2024-05-22

### What's Changed

* Support multilevel models by @0xCyyy3000 in https://github.com/MarJose123/filament-webhook-server/pull/25
* Laravel 11 Compatibility by @0xCyyy3000 in https://github.com/MarJose123/filament-webhook-server/pull/24
* Bump dependabot/fetch-metadata from 1.6.0 to 2.1.0 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/23

### New Contributors

* @0xCyyy3000 made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/25

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.0.1...2.1.0

## 2.0.1 - 2024-02-21

### What's Changed

* Bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/17
* Bump actions/dependency-review-action from 3 to 4 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/18
* Added boolean cast for verifySsl by @soixt in https://github.com/MarJose123/filament-webhook-server/pull/21

### New Contributors

* @soixt made their first contribution in https://github.com/MarJose123/filament-webhook-server/pull/21

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/2.0.0...2.0.1

## 2.0.0 - Support Filament v3 - 2023-09-22

### What's Changed

- Bump actions/checkout from 3 to 4 by @dependabot in https://github.com/MarJose123/filament-webhook-server/pull/13

**Full Changelog**: https://github.com/MarJose123/filament-webhook-server/compare/1.2.2...2.0.0

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
