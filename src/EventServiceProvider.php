<?php

namespace Marjose123\FilamentWebhookServer;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Marjose123\FilamentWebhookServer\Listeners\WebhookFailedListener;
use Marjose123\FilamentWebhookServer\Listeners\WebhookSuccessListener;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen  = [
        WebhookCallSucceededEvent::class => [
            WebhookSuccessListener::class,
        ],
        FinalWebhookCallFailedEvent::class => [
            WebhookFailedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
