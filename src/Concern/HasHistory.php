<?php

namespace Marjose123\FilamentWebhookServer\Concern;

trait HasHistory
{
    protected bool $history = false;

    public function history(bool $history = true): static
    {
        $this->history = $history;

        return $this;
    }

    public function canKeepHistory(): bool
    {
        return $this->history;
    }
}
