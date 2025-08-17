<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Illuminate\Support\Arr;

trait HasModels
{
    protected array $models = [];

    protected array $excludedModels = [];

    public function models(array $models): static
    {
        $this->models = $models;

        return $this;
    }

    public function excludedModels(array $models): static
    {
        $this->excludedModels = $models;

        return $this;
    }

    public function getModels(): array
    {
        return Arr::except($this->models, $this->getExcludedModels());
    }

    public function getExcludedModels(): array
    {
        return $this->excludedModels;
    }
}
