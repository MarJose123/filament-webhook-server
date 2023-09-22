<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServer;
use Marjose123\FilamentWebhookServer\Traits\helper;

class Webhooks extends Page implements HasTable
{
    use helper;
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-status-online';

    protected static string $view = 'filament-webhook-server::pages.webhooks';

    public ?array $data = ['header' => null];

    public function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.heading');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-webhook-server::default.pages.navigation.group');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-webhook-server::default.pages.navigation.label');
    }

    protected function getActions(): array
    {
        return [
            Action::make('Add Webhook')
                ->button()
                ->label(
                    __(
                        'filament-webhook-server::default.pages.button.add_new_webhook'
                    )
                )
                ->action('openCreateModal'),
        ];
    }

    public function openCreateModal(): void
    {
        $this->dispatchBrowserEvent('open-modal', ['id' => 'create-webhook']);
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $webhookModel = new FilamentWebhookServer();
        $webhookModel->name = $data['name'];
        $webhookModel->description = $data['description'];
        $webhookModel->url = $data['url'];
        $webhookModel->method = $data['method'];
        $webhookModel->model = ucfirst($data['model']);
        $webhookModel->header = $data['header'];
        $webhookModel->data_option = $data['data_option'];
        $webhookModel->events = $data['events'];
        $webhookModel->verifySsl = $data['verifySsl'];
        $webhookModel->save();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'create-webhook']);
        $this->notify('success', __('filament-webhook-server::default.notification.create.success'));
    }

    protected function getFormSchema(): array
    {
        return [Grid::make(1)->schema(
            [
                TextInput::make('name')->minLength(2)->maxLength(255)->required(),
                Textarea::make('description')->required(),
                TextInput::make('url')->label('Url to Notify')->url()->required(),
                Select::make('method')->options(
                    [
                        'post' => 'Post',
                        'get' => 'Get',
                    ]
                )->required(),
                Select::make('model')->options($this->getAllModelNames())->required(),
                KeyValue::make('header'),
                Radio::make('data_option')->options(
                    [
                        'all' => 'All Model Data',
                        'summary' => 'Summary',
                        'custom' => 'Custom',
                    ]
                )->descriptions(
                    [
                        'all' => 'All Data of the event triggered',
                        'summary' => 'Push only the ID if the record that trigger an event and its timestamp',
                        'custom' => 'Only data defined on model`s toWebhookPayload method',
                    ]
                )->columns(2)->required(),
                CheckboxList::make('events')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                        'restored' => 'Restored',
                        'forceDeleted' => 'Force Deleted',
                    ])
                        ->columns(2),
                Radio::make('verifySsl')->label('Verify SSL?')->boolean()->inline()->required(),

            ]
        ),
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getTableViewForm(): array
    {
        return [Grid::make(1)->schema(
            [
                TextInput::make('name')->minLength(2)->maxLength(255)->required(),
                Textarea::make('description')->required(),
                TextInput::make('url')->label('Url to Notify')->url()->required(),
                Select::make('method')->options(
                    [
                        'post' => 'Post',
                        'get' => 'Get',
                    ]
                )->required(),
                TextInput::make('model')->required(),
                KeyValue::make('header'),
                Radio::make('data_option')->options(
                    [
                        'all' => 'All Model Data',
                        'summary' => 'Summary',
                        'custom' => 'Custom',
                    ]
                )->descriptions(
                    [
                        'all' => 'All Data of the event triggered',
                        'summary' => 'Push only the ID if the record that trigger an event and its timestamp',
                        'custom' => 'Only data defined on model`s toWebhookPayload method',
                    ]
                )->columns(2)->required(),
                CheckboxList::make('events')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                        'restored' => 'Restored',
                        'forceDeleted' => 'Force Deleted',
                    ])
                    ->columns(2),
                Radio::make('verifySsl')->label('Verify SSL?')->boolean()->inline()->required(),

            ]
        ),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('View Logs')
                ->visible(fn (): bool => config('filament-webhook-server.webhook.keep_history'))
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->url(fn (FilamentWebhookServer $record): string => WebhookHistory::getUrl(['client_id' => $record->id])),
            Tables\Actions\ViewAction::make('view')
                ->mountUsing(fn (ComponentContainer $form, FilamentWebhookServer $record) => $form->fill([
                    'name' => $record->name,
                    'description' => $record->description,
                    'url' => $record->url,
                    'method' => $record->method,
                    'model' => $record->model,
                    'header' => $record->header,
                    'data_option' => $record->data_option,
                    'verifySsl' => $record->verifySsl,
                    'events' => $record->events,
                ]))
                ->form($this->getTableViewForm()),
            Tables\Actions\DeleteAction::make('delete')
                ->requiresConfirmation(),
        ];
    }

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return FilamentWebhookServer::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('description'),
            TextColumn::make('model')
                ->label('Module'),
            TextColumn::make('url'),
            BooleanColumn::make('verifySsl'),
            Tables\Columns\TagsColumn::make('events')->separator(','),

        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-status-offline';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No Webhook';
    }

    protected function getTableEmptyStateDescription(): ?string
    {
        return 'You may create a webhook using the button below.';
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Tables\Actions\Action::make('create')
                ->label('Create post')
                ->button()
                ->label(
                    __(
                        'filament-webhook-server::default.pages.button.add_new_webhook'
                    )
                )
                ->action('openCreateModal'),
        ];
    }

    protected function getTablePollingInterval(): ?string
    {
        return config('filament-webhook-server.polling', '10s');
    }
}
