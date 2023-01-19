<?php

namespace Marjose123\FilamentWebhookServer\Listeners;

use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;

class FailedWebhookCallListener
{
    public function __construct()
    {
    }

    public function handle(FinalWebhookCallFailedEvent $event)
    {
        ddd($event);
    }
}
