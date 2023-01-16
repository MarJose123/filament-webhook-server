<?php

namespace Marjose123\FilamentWebhookServer\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Spatie\ModelInfo\ModelFinder;

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
                ->action('openCreateModal'),
        ];
    }
    public function openCreateModal(): void
    {
        $this->dispatchBrowserEvent('open-modal', ['id' => 'create-webhook']);
    }

    public function create(): void
    {


        $this->dispatchBrowserEvent('close-modal', ['id' => 'create-webhook']);
        $this->notify('success', __('filament-webhook-server::default.notification.create.success'));
    }
    protected function getFormSchema(): array
    {
        return[
            Grid::make(1)
                ->schema([
                    TextInput::make('name')
                        ->minLength(2)
                        ->maxLength(255)
                        ->required(),
                    Textarea::make('description')
                        ->required(),
                    TextInput::make('URL to Notify')
                        ->url()
                        ->required(),
                    Select::make('method')
                        ->options([
                            'get' => 'Get',
                            'post' => 'Post'
                        ])
                        ->required(),
                    Select::make('model')
                        ->options(ModelFinder::all())
                        ->required(),
                    KeyValue::make('headers')

                ])
        ];
    }

}
