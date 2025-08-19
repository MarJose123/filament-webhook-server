<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Illuminate\Support\Arr;
use Marjose123\FilamentWebhookServer\ModelDiscovery;

trait HasModels
{
    protected array $models = [];

    protected array $excludedModels = [];

    public function includeModels(array $models): static
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
       $discovery = ModelDiscovery::getAllModels();

       $models = array_merge($this->models, $discovery);

       return Arr::except($models, $this->getExcludedModels());
    }

    public function getExcludedModels(): array
    {
        return $this->excludedModels;
    }
}
