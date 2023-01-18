<?php

namespace Marjose123\FilamentWebhookServer\Observers;

use Illuminate\Database\Eloquent\Model;
use Marjose123\FilamentWebhookServer\hookJobProcess;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServer;
use Spatie\ModelInfo\ModelInfo;


class ModelObserver
{
    public function created(Model $model)
    {
        $modelInfo = ModelInfo::forModel($model::class);
        $module = ucfirst(str_replace("App\Models\\","", $modelInfo->class));
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['created'])->where('model', '=', $module)->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'created'))->send();

    }

    public function updated(Model $model)
    {
        $modelInfo = ModelInfo::forModel($model::class);
        $module = ucfirst(str_replace("App\Models\\","", $modelInfo->class));
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['updated'])->where('model', '=', $module)->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'updated'))->send();

    }

    public function deleted(Model $model)
    {
        $modelInfo = ModelInfo::forModel($model::class);
        $module = ucfirst(str_replace("App\Models\\","", $modelInfo->class));
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['deleted'])->where('model', '=', $module)->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'deleted'))->send();
    }

    public function restored(Model $model)
    {
        $modelInfo = ModelInfo::forModel($model::class);
        $module = ucfirst(str_replace("App\Models\\","", $modelInfo->class));
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['restored'])->where('model', '=', $module)->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'restored'))->send();
    }

    public function forceDeleted(Model $model)
    {
        $modelInfo = ModelInfo::forModel($model::class);
        $module = ucfirst(str_replace("App\Models\\","", $modelInfo->class));
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['forceDeleted'])->where('model', '=', $module)->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'forceDeleted'))->send();
    }
}
