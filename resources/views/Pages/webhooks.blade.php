<x-filament::page>

    <x-forms::modal id="create-webhook" width="lg">
        <x-slot name="subheading">
            <h3 class="text-xl">{{ __('filament-webhook-server::default.pages.modal.label') }}</h3>
        </x-slot>
        <x-slot name="content">
            {{$this->form}}
        </x-slot>

        <x-slot name="actions">
            <x-filament::modal.actions full-width>
                <x-filament::button wire:click="create" color="primary">
                    {{ __('filament-webhook-server::default.pages.modal.button.create') }}
                </x-filament::button>
            </x-filament::modal.actions>
        </x-slot>
    </x-forms::modal>
</x-filament::page>
