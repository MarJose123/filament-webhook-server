<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Closure;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServer;
use Marjose123\FilamentWebhookServer\Traits\helper;
use Spatie\ModelInfo\ModelFinder;
use Spatie\ModelInfo\ModelInfo;

class Webhooks extends Page
{
    use helper;

    protected static ?string $navigationIcon = 'heroicon-o-status-online';

    protected static string $view = 'filament-webhook-server::pages.webhooks';

    public ?array $data = ['header' => null];


    protected function getHeading(): string
    {
        return __('filament-webhook-server::default.pages.heading');

    }//end getHeading()


    protected static function getNavigationGroup(): ?string
    {
        return __('filament-webhook-server::default.pages.navigation.group');

    }//end getNavigationGroup()


    protected static function getNavigationLabel(): string
    {
        return __('filament-webhook-server::default.pages.navigation.label');

    }//end getNavigationLabel()


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

    }//end getActions()


    public function openCreateModal(): void
    {
        $this->dispatchBrowserEvent('open-modal', ['id' => 'create-webhook']);

    }//end openCreateModal()


    public function create(): void
    {
        $data = $this->form->getState();
        $webhookModel = new FilamentWebhookServer();
        $webhookModel->name = $data['name'];
        $webhookModel->description = $data['description'];
        $webhookModel->url = $data['url'];
        $webhookModel->method = $data['method'];
        $webhookModel->model = $data['model'];
        $webhookModel->header = $data['header'];
        $webhookModel->data_option = $data['data_option'];
        $webhookModel->verifySsl = $data['verifySsl'];
        $webhookModel->save();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'create-webhook']);
        $this->notify('success', __('filament-webhook-server::default.notification.create.success'));

    }//end create()


    protected function getFormSchema(): array
    {
        return [Grid::make(1)->schema(
            [
                TextInput::make('name')->minLength(2)->maxLength(255)->required(),
                Textarea::make('description')->required(),
                TextInput::make('url')->label('Url to Notify')->url()->required(),
                Select::make('method')->options(
                    [
                        'get'  => 'Get',
                        'post' => 'Post',
                    ]
                )->required(),
                Select::make('model')->options($this->getAllModelNames())->required(),
                KeyValue::make('header'),
                Radio::make('data_option')->options(
                    [
                        'all'     => 'All Model Data',
                        'summary' => 'Summary',
                    ]
                )->descriptions(
                    [
                        'all'     => 'All Data of the event triggered',
                        'summary' => 'Push only the ID if the record that trigger an event and its timestamp',
                    ]
                )->columns(2)->required(),
                Radio::make('verifySsl')->label('Verify SSL?')->boolean()->inline()->required(),

            ]
        )
            ];

    }//end getFormSchema()


    protected function getFormStatePath(): string
    {
        return 'data';

    }//end getFormStatePath()


}//end class
