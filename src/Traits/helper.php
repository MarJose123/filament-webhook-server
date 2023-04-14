<?php

namespace Marjose123\FilamentWebhookServer\Traits;

use Illuminate\Database\Eloquent\Model;
use Marjose123\FilamentWebhookServer\ApiResponseBuilder;

trait helper
{
    public function getAllModelNames()
    {
        $models = [];
        $model_list = config('filament-webhook-server.models');
        foreach ($model_list as $model) {
            $model = str_replace("App\Models\\", '', $model);
            $models[str_replace('::Class', '', $model)] = str_replace('::Class', '', $model);
        }

        return $models;
    }

    public function payload(Model $model, $event, $module, $dataOption = 'summary'): object|array
    {
        return ApiResponseBuilder::create()
                                 ->setModel($model)
                                 ->setDataOption($dataOption)
                                 ->setEvent($event)
                                 ->setModule($module)
                                 ->generate();
    }
}
