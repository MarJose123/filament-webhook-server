<x-filament-panels::page>
    <div>
        {{ $this->table }}
    </div>
    <x-filament::modal id="create-webhook" width="lg"  alignment="center" :close-by-clicking-away="false">
        <x-slot name="heading">
            <h3 class="text-xl">{{ __('filament-webhook-server::default.pages.modal.label') }}</h3>
        </x-slot>

        {{$this->form}}

        <x-slot name="footerActions" style="padding-top: 40px;">
            <x-filament::button wire:click="create" color="primary">
                {{ __('filament-webhook-server::default.pages.modal.button.create') }}
            </x-filament::button>
        </x-slot>
    </x-filament::modal>
</x-filament-panels::page>
