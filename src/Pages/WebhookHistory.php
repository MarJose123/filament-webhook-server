<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;
use Marjose123\FilamentWebhookServer\WebhookPlugin;

class WebhookHistory extends Page implements HasTable
{
    use InteractsWithTable;

    public static function getCluster(): ?string
    {
        return filament()->isServing() && WebhookPlugin::get()->getCluster();
    }

    protected string $view = 'filament-webhook-server::pages.webhook-histories';

    protected static ?string $title = 'Webhook Logs';

    protected static bool $shouldRegisterNavigation = false;

    public ?string $webhookClient_Id = null;

    public function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.history.heading');
    }

    public function mount(): void
    {
        if (filament()->isServing() && WebhookPlugin::get()->canKeepLogs()) {
            $this->webhookClient_Id = request('client_id');
        } else {
            redirect()->intended(url()->previous());
        }
    }

    protected function getTableQuery(): Builder
    {
        return FilamentWebhookServerHistory::query()->where('webhook_client', '=', $this->webhookClient_Id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('uuid')
                ->label('ID'),
            TextColumn::make('status_code')
                ->label('Status Code'),
            TextColumn::make('errorMessage')
                ->label('Error Message'),
            TextColumn::make('errorType')
                ->label('Error Type'),
            TextColumn::make('attempt')
                ->label('Attempt'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('Go Back')
                ->url(Webhooks::getUrl()),
        ];
    }

    protected function getActions(): array
    {
        return [
            Action::make('Go Back')
                ->button()
                ->icon('heroicon-o-arrow-left-circle')
                ->label(
                    __(
                        'filament-webhook-server::default.pages.history.back'
                    )
                )
                ->url(Webhooks::getUrl()),
        ];
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-bookmark';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No transaction log yet';
    }

    protected function getTablePollingInterval(): ?string
    {
        return filament()->isServing() && WebhookPlugin::get()->isPolling() ? WebhookPlugin::get()->getPollingInterval() : null;
    }
}
