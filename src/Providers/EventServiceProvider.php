<?php

namespace Marjose123\FilamentWebhookServer\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Marjose123\FilamentWebhookServer\Events\Listeners\FailedWebhookCallListener;
use Marjose123\FilamentWebhookServer\Events\Listeners\SuccessWebhookCallListener;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        WebhookCallSucceededEvent::class => [
            SuccessWebhookCallListener::class,
        ],
        FinalWebhookCallFailedEvent::class => [
            FailedWebhookCallListener::class,
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
