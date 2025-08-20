<?php

namespace Marjose123\FilamentWebhookServer\Concern;

trait HasPolling
{
    protected bool $polling = false;

    protected int $pollingInterval;

    public function polling(int $seconds = 10): static
    {
        $this->polling = true;
        $this->pollingInterval = $seconds;

        return $this;
    }

    public function getPollingInterval(): string
    {
        return $this->pollingInterval.'s';
    }

    public function isPolling(): bool
    {
        return $this->polling;
    }
}
