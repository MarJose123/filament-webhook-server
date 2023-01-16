<?php

namespace Marjose123\FilamentWebhookServer;

use Filament\PluginServiceProvider;
use Marjose123\FilamentWebhookServer\Pages\Webhooks;
use Spatie\LaravelPackageTools\Package;

class FilamentWebhookServerServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-webhook-server';

    protected array $resources = [
        // CustomResource::class,
    ];

    protected array $pages = [
        Webhooks::class
    ];

    protected array $widgets = [
        // CustomWidget::class,
    ];

    protected array $styles = [
        'plugin-filament-webhook-server' => __DIR__.'/../resources/dist/filament-webhook-server.css',
    ];

    protected array $scripts = [
        'plugin-filament-webhook-server' => __DIR__.'/../resources/dist/filament-webhook-server.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-webhook-server' => __DIR__ . '/../resources/dist/filament-webhook-server.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
                ->hasConfigFile()
                ->hasMigration();
    }
}
