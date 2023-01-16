<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Pages\Actions\Action;
use Filament\Pages\Page;

class Webhooks extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-status-online';

    protected static string $view = 'filament-webhook-server::pages.webhooks';

    protected function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.heading');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament-webhook-server::default.pages.navigation.group');
    }

    protected static function getNavigationLabel(): string
    {
        return __('filament-webhook-server::default.pages.navigation.label');
    }

    protected function getActions(): array
    {
        return [
            Action::make('Add Webhook')
                ->button()
                ->label(__('filament-webhook-server::default.pages.button.add_new_webhook'))
                ->action('openOptionModal'),
        ];
    }

}
