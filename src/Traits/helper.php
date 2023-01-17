<?php

namespace Marjose123\FilamentWebhookServer\Traits;

use Illuminate\Support\Facades\File;

trait helper
{
    public function getAllModelNames()
    {
        $models = [];
        $model_list = config('filament-webhook-server.models');
        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);
        foreach ($model_list as $model) {
            $models[str_replace("::Class","", $model)] = str_replace("::Class","", $model);
        }

        return $models;

    }

}
