<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Pages\Page;

class Webhooks extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-support';

    protected static string $view = 'filament-spatie-backup::pages.backups';

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
            Actions\Action::make('Add Webhook')
                ->button()
                ->label(__(''))
                ->action('openOptionModal'),
        ];
    }

}
