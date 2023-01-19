<?php

namespace Marjose123\FilamentWebhookServer;

use Composer\XdebugHandler\Process;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Marjose123\FilamentWebhookServer\Traits\helper;
use Spatie\WebhookServer\WebhookCall;

class HookJobProcess
{
    use helper;
    private ?Collection $search;
    private ?Model $model;
    private ?string $event;
    private ?string $module;

    public function __construct(Collection $search, Model $model, $event, $module)
    {
        $this->model = $model;
        $this->search = $search;
        $this->event = $event;
        $this->module = $module;
    }

    public function send(): void
    {
        foreach ($this->search as $webhookClient)
        {
            switch ($webhookClient->data_option){
                case "summary":
                    WebhookCall::create()
                        ->url($webhookClient->url)
                        ->maximumTries(3)
                        ->meta(['webhookClient' => $webhookClient->id])
                        ->doNotSign()
                        ->useHttpVerb($webhookClient->method)
                        ->verifySsl($webhookClient->verifySsl)
                        ->withHeaders($webhookClient->header)
                        ->payload([$this->payloadSummary($this->model, $this->event, $this->module)])
                        ->dispatchSync();

                    break;
                case "all":
                   WebhookCall::create()
                        ->url($webhookClient->url)
                        ->maximumTries(3)
                        ->meta(['webhookClient' => $webhookClient->id])
                        ->doNotSign()
                        ->useHttpVerb($webhookClient->method)
                        ->verifySsl($webhookClient->verifySsl)
                        ->withHeaders($webhookClient->header)
                        ->payload([$this->payloadAll($this->model, $this->event, $this->module)])
                        ->dispatchSync();
                    break;
            }
        }
    }


}
