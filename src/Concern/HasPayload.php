<?php

namespace Marjose123\FilamentWebhookServer\Concern;

use Illuminate\Database\Eloquent\Model;
use Marjose123\FilamentWebhookServer\ApiResponseBuilder;

trait HasPayload
{
    public function payload(Model $model, string $event, string $module, string $dataOption = 'summary'): object
    {
        return ApiResponseBuilder::create()
            ->setModel($model)
            ->setDataOption($dataOption)
            ->setEvent($event)
            ->setModule($module)
            ->generate();
    }
}
