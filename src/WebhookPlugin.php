<?php

namespace Marjose123\FilamentWebhookServer;

use Exception;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Marjose123\FilamentWebhookServer\Concern\CanCustomizePage;
use Marjose123\FilamentWebhookServer\Concern\HasLogs;
use Marjose123\FilamentWebhookServer\Concern\HasModels;
use Marjose123\FilamentWebhookServer\Concern\HasNavigation;
use Marjose123\FilamentWebhookServer\Concern\HasPolling;
use Marjose123\FilamentWebhookServer\Concern\HasRoutes;
use Marjose123\FilamentWebhookServer\Concern\HasState;
use Marjose123\FilamentWebhookServer\Observers\ModelObserver;

class WebhookPlugin implements Plugin
{
    use CanCustomizePage;
    use HasLogs;
    use HasModels;
    use HasNavigation;
    use HasPolling;
    use HasState;
    use HasRoutes;

    public function getId(): string
    {
        return 'filament-webhook-server';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function register(Panel $panel): void
    {
        if ($this->isEnabled()) {
            $panel->pages($this->getCustomPages());

            app()->register(EventServiceProvider::class);
        }
    }

    public function boot(Panel $panel): void
    {
        if($this->isEnabled()) {
            $models = $this->getModels();
            foreach ($models as $model) {
                if (class_exists($model)) {
                    try {
                        $model::observe(ModelObserver::class);
                    } catch (Exception $e) {
                        logger()->warning("Failed to register observer for model: $model", [
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            }
        }
    }
}
