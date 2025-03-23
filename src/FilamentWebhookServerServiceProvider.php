<?php

namespace Marjose123\FilamentWebhookServer;

use Illuminate\Database\Eloquent\Model;
use Marjose123\FilamentWebhookServer\Observers\ModelObserver;
use Spatie\LaravelPackageTools\Exceptions\InvalidPackage;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentWebhookServerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-webhook-server';

    public function getPages(): array
    {
        return config('filament-webhook-server.pages');
    }

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
                ->hasConfigFile()
                ->hasTranslations()
                ->hasMigrations(['create_filament-webhook-server_table', 'create_filament_webhook_server_histories_table'])
                ->hasViews();
    }


    /**
     * @throws InvalidPackage
     */
    public function register(): void
    {
        parent::register();
        $this->app->register(EventServiceProvider::class);
    }

    public function boot(): void
    {
        parent::boot();
        self::registerGlobalObserver();
    }

    private static function registerGlobalObserver(): void
    {
        /** @var array|string[] $MODELS */
        $MODELS = config('filament-webhook-server.models', []);

        foreach ($MODELS as $model) {
            if (class_exists($model)) {
                $model::observe(ModelObserver::class);
            }
        }
    }
}
