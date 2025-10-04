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
        // If models are explicitly set, use only those
        if (!empty($this->models)) {
            return array_diff($this->models, $this->getExcludedModels());
        }

        // Otherwise, use discovered models
        $discovery = ModelDiscovery::getAllModels();

        return array_diff($discovery, $this->getExcludedModels());
    }


    public function getExcludedModels(): array
    {
        return $this->excludedModels;
    }
}
