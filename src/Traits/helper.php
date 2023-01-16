<?php

namespace Marjose123\FilamentWebhookServer\Traits;

use Illuminate\Support\Facades\File;

trait helper
{
    public function getAllModelNames()
    {
        $models = [];
        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);
        foreach ($modelFiles as $modelFile) {
            $models["{$modelFile->getFilenameWithoutExtension()}"] = $modelFile->getFilenameWithoutExtension();
        }

        return $models;

    }

}
