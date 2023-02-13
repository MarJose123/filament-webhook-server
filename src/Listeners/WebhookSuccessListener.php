<?php

namespace Marjose123\FilamentWebhookServer\Listeners;

use Illuminate\Support\Facades\Log;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServer;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class WebhookSuccessListener
{
    public function __construct()
    {
    }

    public function handle(WebhookCallSucceededEvent $event)
    {
        if(config('filament-webhook-server.webhook.keep_history')){
            try {
                $webhookClientHistory = new FilamentWebhookServerHistory();
                $webhookClientHistory->webhook_client = $event->meta['webhookClient'];
                $webhookClientHistory->uuid = $event->uuid;
                $webhookClientHistory->status_code = $event->response->getStatusCode();
                $webhookClientHistory->errorMessage = "";
                $webhookClientHistory->errorType = "";
                $webhookClientHistory->attempt = $event->attempt;
                $res = $webhookClientHistory->save();
            }catch (\Exception $error){
                Log::info(print_r($error, true));
            }
        }




    }
}
