<?php

namespace Marjose123\FilamentWebhookServer\Interface;

interface Webhookable
{
    public function toWebhookPayload(): array;
}
