<?php

use Marjose123\FilamentWebhookServer\Pages\WebhookHistory;
use Marjose123\FilamentWebhookServer\Pages\Webhooks;

return [
    /*
     *  Models that you want to be part of the webhooks options
     */
    'models' => [
        \App\Models\User::class,
    ],
    /*
     */
    'polling' => '10s',
    'webhook' => [
        'keep_history' => false,
    ],
    /*
    * Use to put pages within Clusters
    */
    'cluster' => null,
    'pages' => [
        Webhooks::class,
        WebhookHistory::class,
    ],
    'navigation' => [
        'icon' => 'heroicon-s-arrow-up-on-square-stack',
        'sort' => 0,
    ],
];
