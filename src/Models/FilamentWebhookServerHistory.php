<?php

namespace Marjose123\FilamentWebhookServer\Models;

use Illuminate\Database\Eloquent\Model;

class FilamentWebhookServerHistory extends Model
{
    protected $fillable = [
        'webhook_client',
        'uuid',
        'status_code',
        'errorMessage',
        'errorType',
        'attempt',
    ];
}
