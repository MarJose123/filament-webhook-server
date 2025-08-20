<?php

namespace Marjose123\FilamentWebhookServer\Observers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Marjose123\FilamentWebhookServer\HookJobProcess;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServer;
use ReflectionClass as RC;
use ReflectionException;
use Spatie\ModelInfo\ModelInfo;

class ModelObserver
{
    /**
     * @param Model $model
     * @return void
     */
    public function created(Model $model): void
    {
        $module = ucfirst((new RC($model))->getShortName());
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['created'])
            ->where(function (Builder $query) use ($module, $model): void {
                $query->where('model', '=', $module);
                $query->orWhere('model', '=', $model);
            })->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'created', $module))->send();
    }

    /**
     * @param Model $model
     * @return void
     */
    public function updated(Model $model): void
    {
        $module = ucfirst((new RC($model))->getShortName());
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['updated'])
            ->where(function (Builder $query) use ($module, $model): void {
                $query->where('model', '=', $module);
                $query->orWhere('model', '=', $model);
            })->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'updated', $module))->send();
    }

    /**
     * @param Model $model
     * @return void
     */
    public function deleted(Model $model): void
    {
        $module = ucfirst((new RC($model))->getShortName());
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['deleted'])
            ->where(function (Builder $query) use ($module, $model): void {
                $query->where('model', '=', $module);
                $query->orWhere('model', '=', $model);
            })->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'deleted', $module))->send();
    }

    /**
     * @param Model $model
     * @return void
     */
    public function restored(Model $model): void
    {
        $module = ucfirst((new RC($model))->getShortName());
        /*
         * Search on the DB that want to receive webhook from this model
         */
        $search = FilamentWebhookServer::query()->whereJsonContains('events', ['restored'])
            ->where(function (Builder $query) use ($module, $model): void {
                $query->where('model', '=', $module);
                $query->orWhere('model', '=', $model);
            })->get();
        /*
         * Send to Job Process
         */
        (new HookJobProcess($search, $model, 'restored', $module))->send();
    }

}
