<?php

namespace Marjose123\FilamentWebhookServer\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServer;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class WebhookController extends BaseController
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'url' => ['required', 'string'],
            'method' => ['required', 'string', 'in:get,post'],
            'model' => ['required', 'string'],
            'header' => ['sometimes', 'required', 'string'],
            'data_option' => ['required', 'string', 'in:all,summary,custom'],
            'verifySsl' => ['required', 'boolean'],
            'events' => ['required', 'array'],
            'events.*' => ['required', 'string', 'min:1', 'in:created,updated,deleted,restored,forceDeleted'],
        ]);

        try {
            $webhook = FilamentWebhookServer::create($request->all());

            return new JsonResponse([
                'message' => 'Webhook created!',
                'webhook_id' => $webhook->id,
            ], ResponseAlias::HTTP_CREATED);
        } catch (Throwable $throwable) {
            return new JsonResponse([
                'error' => [
                    'message' => $throwable->getMessage(),
                ],
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get()
    {
        try {
            return new JsonResponse(FilamentWebhookServer::all(), ResponseAlias::HTTP_OK);
        } catch (Throwable $throwable) {
            return new JsonResponse([
                'error' => [
                    'message' => $throwable->getMessage(),
                ],
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => ['sometimes', 'required', 'string'],
                'description' => ['sometimes', 'required', 'string'],
                'url' => ['sometimes', 'required', 'string'],
                'method' => ['sometimes', 'required', 'string', 'in:get,post'],
                'model' => ['sometimes', 'required', 'string'],
                'header' => ['sometimes', 'required', 'string'],
                'data_option' => ['sometimes', 'required', 'string', 'in:all,summary,custom'],
                'verifySsl' => ['sometimes', 'required', 'boolean'],
                'events' => ['sometimes', 'required', 'array'],
                'events.*' => ['sometimes', 'required', 'string', 'min:1', 'in:created,updated,deleted,restored,forceDeleted'],
            ]);

            $webhook = FilamentWebhookServer::findOrFail($id);
            $webhook->update($request->all());

            return new JsonResponse(['message' => 'Webhook updated!'], ResponseAlias::HTTP_OK);
        } catch (Throwable $throwable) {
            return new JsonResponse([
                'error' => [
                    'message' => $throwable->getMessage(),
                ],
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $webhook = FilamentWebhookServer::findOrFail($id);
            $webhook->delete();

            return new JsonResponse(['message' => 'Webhook deleted!'], ResponseAlias::HTTP_OK);
        } catch (Throwable $throwable) {
            return new JsonResponse([
                'error' => [
                    'message' => $throwable->getMessage(),
                ],
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
