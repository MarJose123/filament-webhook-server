<?php

namespace Marjose123\FilamentWebhookServer\Traits;

use Illuminate\Support\Facades\File;

trait helper
{
    public function getAllModelNames()
    {
        $models = [];
        $model_list = config('filament-webhook-server.models');
        foreach ($model_list as $model) {
            $model = str_replace("App\Models\\","", $model);
            $models[str_replace("::Class","", $model)] = str_replace("::Class","", $model);
        }

        return $models;

    }

}
