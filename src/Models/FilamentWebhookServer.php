<?php

namespace Marjose123\FilamentWebhookServer\Models;

use Illuminate\Database\Eloquent\Model;

class FilamentWebhookServer extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'method',
        'model',
        'header',
        'data_option',
        'verifySsl',
        'status',
        'events',
    ];

    public function transactionlogs()
    {
        return $this->hasMany(FilamentWebhookServerHistory::class, 'webhook_client', 'id');
    }

    protected function casts(): array
    {
        return [
            'header' => 'array',
            'events' => 'array',
            'verifySsl' => 'boolean',
        ];
    }
}
