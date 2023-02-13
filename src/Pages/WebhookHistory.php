<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

class WebhookHistory extends Page implements HasTable
{
    use InteractsWithTable;
    protected static string $view = 'filament-webhook-server::pages.webhooks-histories';
    protected static ?string $title = 'Webhook Transaction Logs';
    protected static bool $shouldRegisterNavigation = false;

    protected function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.history.heading');
    }

}
