<?php

namespace Marjose123\FilamentWebhookServer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApiResponseBuilder
{
    private Model $model;

    private ?string $message;

    private ?string $dataOption;

    private ?string $event;

    private ?string $module;

    public static function create(): ApiResponseBuilder
    {
        return (new static())
            ->setMessage(null);
    }

    public function setModel(Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function setModule($module): static
    {
        $this->module = $module;

        return $this;
    }

    public function setEvent($event): static
    {
        $this->event = $event;

        return $this;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function setDataOption(string $dataOption): static
    {
        $this->dataOption = $dataOption;

        return $this;
    }

    public function generate()
    {
        $payload = match ($this->dataOption) {
            'summary' => [
                'id'         => $this->model->id ?? $this->model->uuid ?? null,
                'created_at' => $this->model->created_at ?? Carbon::now()->timezone(config('app.timezone')),
                'updated_at' => $this->model->updated_at ?? null,
            ],
            'all' => (object)$this->model->attributesToArray(),
            'custom' => method_exists($this->model, 'toWebhookPayload')
                ? (object)$this->model->toWebhookPayload() : [],
            default => [],
        };
        $apiReponse = [
            'event' => $this->event ?? null,
            'module' => $this->module,
            'triggered_at' => Carbon::now()->timezone(config('app.timezone')),
            'data' => $payload,
        ];

        return (object)$apiReponse;
    }
}
