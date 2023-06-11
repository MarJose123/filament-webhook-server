<?php

namespace Marjose123\FilamentWebhookServer;

use Filament\PluginServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Marjose123\FilamentWebhookServer\Observers\ModelObserver;
use Spatie\LaravelPackageTools\Exceptions\InvalidPackage;
use Spatie\LaravelPackageTools\Package;

class FilamentWebhookServerServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-webhook-server';

    protected array $resources = [
        // CustomResource::class,
    ];

    public function getPages(): array
    {
        return config('filament-webhook-server.pages');
    }

    protected array $widgets = [
        // CustomWidget::class,
    ];

    protected array $styles = [
        //        'plugin-filament-webhook-server' => __DIR__.'/../resources/dist/filament-webhook-server.css',
    ];

    protected array $scripts = [
        //        'plugin-filament-webhook-server' => __DIR__.'/../resources/dist/filament-webhook-server.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-webhook-server' => __DIR__ . '/../resources/dist/filament-webhook-server.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
                ->hasConfigFile()
                ->hasTranslations()
                ->hasMigrations(['create_filament-webhook-server_table', '2023_01_19_144816_create_filament_webhook_server_histories_table'])
                ->hasViews();
    }

    /**
     * @throws InvalidPackage
     */
    public function register()
    {
        parent::register();
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        parent::boot();
        self::registerGlobalObserver();
    }

    private static function registerGlobalObserver()
    {
        /** @var Model[] $MODELS */
        $MODELS = [
            config('filament-webhook-server.models'),
        ];

        foreach ($MODELS as $MODEL) {
            foreach ($MODEL as $model) {
                $model::observe(ModelObserver::class);
            }
        }
    }
}
