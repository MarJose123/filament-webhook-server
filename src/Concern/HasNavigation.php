<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Filament\Support\Concerns\HasIcon;

trait HasNavigation
{
    use HasIcon;

    protected int $sort = 0;

    protected ?string $navigationGroup = null;

    public function navigationGroup(string $navigationGroup): static
    {
        $this->navigationGroup = $navigationGroup;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        return $this->navigationGroup ?? __('filament-webhook-server::default.pages.navigation.group');
    }

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
