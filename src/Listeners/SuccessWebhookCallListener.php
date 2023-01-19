<?php

namespace Marjose123\FilamentWebhookServer\Listeners;

use Spatie\WebhookServer\Events\WebhookCallFailedEvent;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class SuccessWebhookCallListener
{
    public function __construct()
    {
    }

    public function handle(WebhookCallSucceededEvent $event)
    {
        ddd($event);
    }
}
