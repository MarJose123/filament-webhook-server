<?php

namespace Marjose123\FilamentWebhookServer\Concern;

trait HasLogs
{
    protected bool $enableLogs = false;

    public function keepLogs(bool $history = true): static
    {
        $this->enableLogs = $history;

        return $this;
    }

    public function canKeepLogs(): bool
    {
        return $this->enableLogs;
    }
}
