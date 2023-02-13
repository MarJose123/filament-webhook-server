<?php

namespace Marjose123\FilamentWebhookServer\Listeners;

use Illuminate\Support\Facades\Log;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;
use Spatie\WebhookServer\Events\WebhookCallFailedEvent;

class WebhookFailedListener
{
    public function __construct()
    {
    }

    public function handle(WebhookCallFailedEvent $event)
    {
        if(config('filament-webhook-server.webhook.keep_history')){
            try {
                $webhookClientHistory = new FilamentWebhookServerHistory();
                $webhookClientHistory->webhook_client = $event->meta['webhookClient'];
                $webhookClientHistory->uuid = $event->uuid;
                $webhookClientHistory->status_code = $event->response->getStatusCode();
                $webhookClientHistory->errorMessage = $event->response->getReasonPhrase();
                $webhookClientHistory->errorType = $event->errorType;
                $webhookClientHistory->attempt = $event->attempt;
                $res = $webhookClientHistory->save();
            }catch (\Exception $error){
                Log::info(print_r($error, true));
            }
        }
    }
}
