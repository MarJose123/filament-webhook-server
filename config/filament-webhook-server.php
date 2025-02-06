<?php

use Marjose123\FilamentWebhookServer\Pages\WebhookHistory;
use Marjose123\FilamentWebhookServer\Pages\Webhooks;

return [
    /*
     *  Models that you want to be part of the webhooks options
     */
    'models' => [],
    /*
     */
    'polling' => '10s',
    'webhook' => [
        'keep_history' => false,
    ],
    'pages' => [
        Webhooks::class,
        WebhookHistory::class,
    ],
    'navigation' => [
        'icon' => 'heroicon-s-arrow-up-on-square-stack'
    ]
];
