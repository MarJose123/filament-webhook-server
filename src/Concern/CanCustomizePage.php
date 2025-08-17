<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Marjose123\FilamentWebhookServer\Pages\WebhookHistory;
use Marjose123\FilamentWebhookServer\Pages\Webhooks;

trait CanCustomizePage
{
    protected string $webhookPage = Webhooks::class;

    protected string $webhookHistoryPage = WebhookHistory::class;

    protected ?string $cluster = null;

    public function customPageUsing(string $webhookPage, string $webhookHistoryPage): static
    {
        $this->webhookPage = $webhookPage;
        $this->webhookHistoryPage = $webhookHistoryPage;

        return $this;
    }

    public function getWebhookPage(): string
    {
        return $this->webhookPage;
    }

    public function getWebhookHistoryPage(): string
    {
        return $this->webhookHistoryPage;
    }

    public function getCustomPages(): array
    {
        return [
            $this->getWebhookPage(),
            $this->getWebhookHistoryPage(),
        ];
    }

    public function cluster(string $cluster): static
    {
        $this->cluster = $cluster;

        return $this;
    }

    public function getCluster(): ?string
    {
        return $this->cluster;
    }
}
