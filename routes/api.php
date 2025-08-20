<?php

use Illuminate\Support\Facades\Route;
use Marjose123\FilamentWebhookServer\Http\Controllers\WebhookController;
use Marjose123\FilamentWebhookServer\WebhookPlugin;

if (WebhookPlugin::get()->isEnabled() && WebhookPlugin::get()->isApiRoutesEnabled()) {
    Route::prefix('/webhook-server/api')->middleware(['web', 'auth:sanctum'])->group(function (): void {
        Route::get('/', [WebhookController::class, 'get']);
        Route::post('/', [WebhookController::class, 'create']);
        Route::patch('/{id}', [WebhookController::class, 'update']);
        Route::delete('/{id}', [WebhookController::class, 'delete']);
    });
}
