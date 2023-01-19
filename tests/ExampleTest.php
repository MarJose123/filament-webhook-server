<?php
use function Pest\Livewire\livewire;

it('can render page', function () {
    livewire(\Marjose123\FilamentWebhookServer\Pages\Webhooks::class)->assertSuccessful();
});
