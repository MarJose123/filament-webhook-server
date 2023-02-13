<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;

class WebhookHistory extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament-webhook-server::pages.webhooks-histories';

    protected static ?string $title = 'Webhook Transaction Logs';

    protected static bool $shouldRegisterNavigation = false;

    protected string $webhookClient_Id;

    protected function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.history.heading');
    }

    public function mount()
    {

     if(config('filament-webhook-server.webhook.keep_history')){
         $this->webhookClient_Id = request('client_id');
         /* Abort the request if the  is empty */
         abort_unless(isset($this->webhookClient_Id), 403);

     }

      $this->redirect(url()->previous());
    }

    protected function getTableQuery(): Builder
    {
        return FilamentWebhookServerHistory::query()->where('webhook_client', '=', $this->webhookClient_Id);
    }

    protected function getTableColumns(): array
    {
        return  [
            Grid::make(1)->schema([
                TextInput::make('uuid'),
                TextInput::make('status_code'),
                TextInput::make('errorMessage'),
                TextInput::make('errorType'),
                TextInput::make('attempt'),
            ])
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

}
