<?php

namespace Marjose123\FilamentWebhookServer\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;
use Marjose123\FilamentWebhookServer\WebhookPlugin;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class WebhookSuccessListener
{
    public function __construct() {}

    public function handle(WebhookCallSucceededEvent $event): void
    {
        if (WebhookPlugin::get()->canKeepLogs()) {
            try {
                FilamentWebhookServerHistory::create([
                    'webhook_client' => $event->meta['webhookClient'],
                    'uuid' => $event->uuid,
                    'status_code' => $event->response->getStatusCode(),
                    'errorMessage' => null,
                    'errorType' => null,
                    'attempt' => $event->attempt,
                ]);
            } catch (Exception $exception) {
                Log::error('Failed to save webhook history: ', [
                    'error' => $exception->getMessage(),
                ] );
            }
        }
    }
}
