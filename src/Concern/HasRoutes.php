<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Filament\Support\Concerns\EvaluatesClosures;

trait HasRoutes
{

    protected bool $enableApiRoutes = false;

    public function enableApiRoutes(bool $enable = true): static
    {
        $this->enableApiRoutes = $enable;
        return $this;
    }

    public function isApiRoutesEnabled(): bool
    {
        return $this->enableApiRoutes;
    }

}
