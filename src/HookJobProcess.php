<?php

namespace Marjose123\FilamentWebhookServer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Marjose123\FilamentWebhookServer\Concern\HasPayload;
use Spatie\WebhookServer\WebhookCall;

class HookJobProcess
{
    use HasPayload;

    public function __construct(private ?Collection $search, private ?Model $model, private ?string $event, private ?string $module)
    {
    }

    public function send(): void
    {
        foreach ($this->search as $webhookClient) {
            WebhookCall::create()
                ->url($webhookClient->url)
                ->maximumTries(3)
                ->meta(['webhookClient' => $webhookClient->id])
                ->doNotSign()
                ->useHttpVerb($webhookClient->method)
                ->verifySsl($webhookClient->verifySsl)
                ->withHeaders($webhookClient->header)
                ->payload([$this->payload($this->model, $this->event, $this->module, $webhookClient->data_option)])
                ->dispatchSync();
        }
    }
}
