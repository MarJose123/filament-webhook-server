<x-filament::page>
    <div>
        {{ $this->table }}
    </div>
    <x-forms::modal id="create-webhook" width="lg">
        <x-slot name="subheading">
            <h3 class="text-xl">{{ __('filament-webhook-server::default.pages.modal.label') }}</h3>
        </x-slot>
        {{$this->form}}

        <x-slot name="actions" style="padding-top: 40px;">
            <x-filament::modal.actions>
                <x-filament::button wire:click="create" color="primary">
                    {{ __('filament-webhook-server::default.pages.modal.button.create') }}
                </x-filament::button>
            </x-filament::modal.actions>
        </x-slot>
    </x-forms::modal>
</x-filament::page>
