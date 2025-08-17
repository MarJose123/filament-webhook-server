<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Filament\Support\Concerns\EvaluatesClosures;

trait HasState
{
    use EvaluatesClosures;

    protected bool $enabled = true;

    public function enablePlugin(\Closure|bool $enable = true): static
    {
        $this->enabled = (bool) $this->evaluate($enable);

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
