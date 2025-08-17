<?php

namespace Marjose123\FilamentWebhookServer;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Marjose123\FilamentWebhookServer\Concern\CanCustomizePage;
use Marjose123\FilamentWebhookServer\Concern\HasLogs;
use Marjose123\FilamentWebhookServer\Concern\HasModels;
use Marjose123\FilamentWebhookServer\Concern\HasNavigation;
use Marjose123\FilamentWebhookServer\Concern\HasPolling;
use Marjose123\FilamentWebhookServer\Concern\HasState;

class WebhookPlugin implements Plugin
{
    use CanCustomizePage;
    use HasLogs;
    use HasModels;
    use HasNavigation;
    use HasPolling;
    use HasState;

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
        }
    }

    public function boot(Panel $panel): void {}
}
