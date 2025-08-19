<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServer;
use Marjose123\FilamentWebhookServer\Traits\helper;
use Marjose123\FilamentWebhookServer\WebhookPlugin;

class Webhooks extends Page implements HasSchemas, HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament-webhook-server::pages.webhooks';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = ['header' => null];

    public static function getCluster(): ?string
    {
        return filament()->isServing() && WebhookPlugin::get()->getCluster() ? WebhookPlugin::get()->getCluster() : null;
    }

    public static function getNavigationIcon(): string|Heroicon|Htmlable|null
    {
        return filament()->isServing() && WebhookPlugin::get()->getIcon() ? WebhookPlugin::get()->getIcon() : Heroicon::OutlinedBolt;
    }

    public function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.heading');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-webhook-server::default.pages.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return filament()->isServing() && WebhookPlugin::get()->getSort() ? WebhookPlugin::get()->getSort() : 0;
    }

    public function mount(): void
    {
        $this->form->fill([
            'header' => [
                'Content-Type' => 'application/json',
            ],
        ]);
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
        $this->dispatch('open-modal', id: 'create-webhook');
    }

    public function create(): void
    {

       $this->form->getState();

        FilamentWebhookServer::create([
            'name' => $this->data['name'],
            'description' => $this->data['description'],
            'url' => $this->data['url'],
            'method' => $this->data['method'],
            'model' => ucfirst($this->data['model']),
            'header' => $this->data['header'],
            'data_option' => $this->data['data_option'],
            'events' => $this->data['events'],
            'verifySsl' => $this->data['verifySsl'],
        ]);

        $this->dispatch('close-modal', id: 'create-webhook');

        Notification::make()
            ->success()
            ->body(__('filament-webhook-server::default.notification.create.success'))
            ->send();
    }

    protected function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(1)
                ->schema([
                    TextInput::make('name')
                        ->minLength(2)
                        ->maxLength(255),
                    Textarea::make('description')
                        ->required(),
                    TextInput::make('url')
                        ->label('Url to Notify')
                        ->rule([
                            'required',
                            'url:http,https',
                        ]),
                    Radio::make('method')
                        ->options([
                            'post' => 'Post',
                            'get' => 'Get',
                        ])
                        ->inline()
                        ->columns()
                        ->required(),
                    Select::make('model')
                        ->native(false)
                        ->searchable()
                        ->options(filament()->isServing() ? WebhookPlugin::get()->getModels() : [])
                        ->required(),
                    KeyValue::make('header'),
                    Radio::make('data_option')
                        ->options([
                            'all' => 'All Model Data',
                            'summary' => 'Summary',
                            'custom' => 'Custom',
                        ])->descriptions([
                            'all' => 'All Data of the event triggered',
                            'summary' => 'Push only the ID if the record that trigger an event and its timestamp',
                            'custom' => 'Only data defined on model\'s toWebhookPayload method',
                        ])
                        ->columns(2)
                        ->required(),
                    CheckboxList::make('events')
                        ->options([
                            'created' => 'Created',
                            'updated' => 'Updated',
                            'deleted' => 'Deleted',
                            'restored' => 'Restored',
                            'forceDeleted' => 'Force Deleted',
                        ])
                        ->columns(2),
                    Radio::make('verifySsl')
                        ->label('Verify SSL?')
                        ->boolean()
                        ->inline()
                        ->required(),

                ]
                ),
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    protected function getTableViewForm(): array
    {
        return [Grid::make(1)->schema(
            [
                TextInput::make('name')->minLength(2)->maxLength(255)->required(),
                Textarea::make('description')->required(),
                TextInput::make('url')->label('Url to Notify')->url()->required(),
                Select::make('method')
                    ->options([
                        'post' => 'Post',
                        'get' => 'Get',
                    ])
                    ->required(),
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

    public static function table(Table $table): Table
    {
        return $table
            ->extremePaginationLinks()
            ->modifyQueryUsing(fn (Builder $query) => $query->orderBy('created_at', 'DESC')->withoutGlobalScopes());
    }

    protected function getTableActions(): array
    {
        return [
            ViewAction::make('view')
                ->modalHeading('View Webhook')
                ->schema(fn(Schema $schema): Schema => $this->form($schema))
                ->mountUsing(fn (Schema $form, FilamentWebhookServer $record): Schema => $form->fill([
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
                ->modalFooterActionsAlignment(Alignment::End)
            ->modalWidth(Width::Medium),
            Action::make('Logs')
                ->visible(fn (): bool => filament()->isServing() && WebhookPlugin::get()->canKeepLogs())
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->url(fn (FilamentWebhookServer $record): string => WebhookHistory::getUrl(['client_id' => $record->id])),
            DeleteAction::make('delete')
                ->requiresConfirmation(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return FilamentWebhookServer::query();
    }

    protected static function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('description')
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('model')
                ->label('Module'),
            TextColumn::make('url')
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('verifySsl')
                ->formatStateUsing(fn ($state): string => $state ? 'Yes' : 'No'),
            TextColumn::make('events')
                ->badge()
                ->separator()
                ->wrap(),

        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

    protected function getTableEmptyStateIcon(): string
    {
        return filament()->isServing() && WebhookPlugin::get()->getIcon() ? WebhookPlugin::get()->getIcon() : 'heroicon-o-bolt';
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
            Action::make('create')
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

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                EmbeddedTable::make(), // This is the component that renders the table that is defined in this resource
            ]);
    }
}
