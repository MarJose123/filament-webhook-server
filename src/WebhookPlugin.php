<?php

namespace Marjose123\FilamentWebhookServer;

use Filament\Contracts\Plugin;
use Filament\Panel;

class WebhookPlugin implements Plugin
{

    public function getId(): string
    {
        return 'filament-webhook-server';
    }

    public function register(Panel $panel): void
    {
        $panel->pages([
            config('filament-webhook-server.pages')
        ]);
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

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
