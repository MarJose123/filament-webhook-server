<?php

namespace Marjose123\FilamentWebhookServer;

use Filament\PluginServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Marjose123\FilamentWebhookServer\Observers\ModelObserver;
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
                ->hasMigration('create_filament-webhook-server_table.php')
                ->hasViews();
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
            config('filament-webhook-server.models')
        ];

        foreach ($MODELS as $MODEL) foreach ($MODEL as $model)
        {
            sprintf("\\App\\Models\\%s", $model)::observe(ModelObserver::class);
        }
    }
}
