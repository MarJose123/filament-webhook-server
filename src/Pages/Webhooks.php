<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Closure;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Marjose123\FilamentWebhookServer\Traits\helper;
use Spatie\ModelInfo\ModelFinder;
use Spatie\ModelInfo\ModelInfo;

class Webhooks extends Page
{
    use helper;
    protected static ?string $navigationIcon = 'heroicon-o-status-online';

    protected static string $view = 'filament-webhook-server::pages.webhooks';

    public $data;

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
                ->action('openCreateModal'),
        ];
    }
    public function openCreateModal(): void
    {
        $this->dispatchBrowserEvent('open-modal', ['id' => 'create-webhook']);
    }

    public function create(): void
    {
        ddd($this->form->getState());


        $this->dispatchBrowserEvent('close-modal', ['id' => 'create-webhook']);
        $this->notify('success', __('filament-webhook-server::default.notification.create.success'));
    }
    protected function getFormSchema(): array
    {
        return[
//            ddd(ModelInfo::forAllModels()),
            Grid::make(1)
                ->schema([
                    TextInput::make('name')
                        ->minLength(2)
                        ->maxLength(255)
                        ->required(),
                    Textarea::make('description')
                        ->required(),
                    TextInput::make('url')
                        ->label('URL to Notify')
                        ->url()
                        ->required(),
                    Select::make('method')
                        ->options([
                            'get' => 'Get',
                            'post' => 'Post'
                        ])
                        ->required(),
                    Select::make('model')
                        ->options($this->getAllModelNames())
                        ->required()
                        ->reactive(),
                    KeyValue::make('headers'),
                    Radio::make('data_option')
                        ->options([
                            'all' => 'All Model Data',
                            'custom' => 'Custom Data',
                        ])
                        ->reactive()
                        ->columns(2),
                    Repeater::make('data_custom')
                        ->schema([
                           TextInput::make('Key')
                                ->required(),
                           Select::make('value')
                                ->label('Model Key Value')
                                ->options(function (Closure $get) {
                                    $modelInfo = ModelInfo::forModel($get('model').'::class');
                                    ddd($modelInfo);
                                })
                        ])
                            ->visible(fn(Closure $get) => $get('data_option') === 'custom' )
                            ->required(fn(Closure $get) => $get('data_option') === 'custom' ),
                    Radio::make('verifySsl')
                        ->label('Verify Ssl?')
                        ->boolean()
                        ->inline()

                ])
        ];
    }
    protected function getFormStatePath(): string
    {
        return 'data';
    }

}
