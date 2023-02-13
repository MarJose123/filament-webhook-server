<?php

namespace Marjose123\FilamentWebhookServer\Listeners;

use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;
use Marjose123\FilamentWebhookServer\Traits\helper;
use Spatie\WebhookServer\Events\WebhookCallFailedEvent;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class SuccessWebhookCallListener
{
    use helper;
    public function __construct()
    {
    }

    public function handle(WebhookCallSucceededEvent $event)
    {

        if(config('filament-webhook-server.webhook.keep_history'))
        {
            $webhookClientHistory = new FilamentWebhookServerHistory();
            $webhookClientHistory->webhook_client = $event->meta['webhookClient'];
            $webhookClientHistory->uuid = $event->uuid;
            $webhookClientHistory->status_code = $event->response->getStatusCode();
            $webhookClientHistory->errorMessage = $event->errorMessager;
            $webhookClientHistory->errorType = $event->errorType;
            $webhookClientHistory->attempt = $event->attempt;
            $res = $webhookClientHistory->save();
        }
    }
}
