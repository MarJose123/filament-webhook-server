<?php

namespace Marjose123\FilamentWebhookServer;

use Marjose123\FilamentWebhookServer\Observers\ModelObserver;
use Spatie\LaravelPackageTools\Exceptions\InvalidPackage;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentWebhookServerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-webhook-server';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasTranslations()
            ->hasMigrations(['create_filament-webhook-server_table', 'create_filament_webhook_server_histories_table'])
            ->hasViews();
    }

}
