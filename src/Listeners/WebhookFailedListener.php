<?php

namespace Marjose123\FilamentWebhookServer\Listeners;

use Exception;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;
use Marjose123\FilamentWebhookServer\WebhookPlugin;
use Spatie\WebhookServer\Events\WebhookCallFailedEvent;

class WebhookFailedListener
{
    public function __construct() {}

    public function handle(WebhookCallFailedEvent $event): void
    {
        if (WebhookPlugin::get()->canKeepLogs()) {
            try {
                FilamentWebhookServerHistory::create([
                    'webhook_client' => $event->meta['webhookClient'],
                    'uuid' => $event->uuid,
                    'status_code' => $event->response->getStatusCode(),
                    'errorMessage' => $event->response->getReasonPhrase(),
                    'errorType' => $event->errorType,
                    'attempt' => $event->attempt,
                ]);
            } catch (Exception $exception) {
                logger()->error('Failed to save webhook history: ', [
                    'error' => $exception->getMessage(),
                ]);
            }
        }
    }
}
