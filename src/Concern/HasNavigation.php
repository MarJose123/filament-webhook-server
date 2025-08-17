<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Filament\Support\Concerns\HasIcon;

trait HasNavigation
{
    use HasIcon;

    protected int $sort = 0;

    public function sort(int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function getSort(): int
    {
        return $this->sort;
    }
}
