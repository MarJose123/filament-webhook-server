<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;

class WebhookHistory extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament-webhook-server::pages.webhook-histories';

    protected static ?string $title = 'Webhook Transaction Logs';

    protected static bool $shouldRegisterNavigation = false;

    public string|null $webhookClient_Id;

    protected function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.history.heading');
    }

    public function mount()
    {
        if (config('filament-webhook-server.webhook.keep_history')) {
            $this->webhookClient_Id = request('client_id');
        } else {
            $this->redirect(url()->previous());
        }
    }

    protected function getTableQuery(): Builder
    {
        return FilamentWebhookServerHistory::query()->where('webhook_client', '=', $this->webhookClient_Id);
    }

    protected function getTableColumns(): array
    {
        return  [
            TextColumn::make('uuid'),
            TextColumn::make('status_code'),
            TextColumn::make('errorMessage'),
            TextColumn::make('errorType'),
            TextColumn::make('attempt'),
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
            \Filament\Pages\Actions\Action::make('Go Back')
                ->button()
                ->icon('heroicon-o-arrow-narrow-left')
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
        return config('filament-webhook-server.polling', '10s');
    }
}
