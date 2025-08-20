<?php

namespace Marjose123\FilamentWebhookServer;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class ModelDiscovery
{
    /**
     * Get all Eloquent models in the application
     */
    public static function getAllModels(): array
    {
        $models = [];
        $modelPaths = self::getModelPaths();

        foreach ($modelPaths as $path) {
            $models = array_merge($models, self::getModelsFromPath($path));
        }

        return array_unique($models);
    }

    /**
     * Get potential model paths
     */
    private static function getModelPaths(): array
    {
        return [
            app_path('Models'),
        ];
    }

    /**
     * Get models from a specific path
     */
    private static function getModelsFromPath(string $path): array
    {
        if (! is_dir($path)) {
            return [];
        }

        $models = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $className = self::getClassNameFromFile($file->getPathname());

            if ($className && self::isEloquentModel($className)) {
                $models[] = $className;
            }
        }

        return $models;
    }

    /**
     * Extract a class name from a PHP file
     */
    private static function getClassNameFromFile(string $filePath): ?string
    {
        $contents = file_get_contents($filePath);
        $namespace = null;
        $className = null;

        // Extract namespace
        if (preg_match('/namespace\s+([^;]+);/', $contents, $matches)) {
            $namespace = $matches[1];
        }

        // Extract class name
        if (preg_match('/class\s+([^\s]+)/', $contents, $matches)) {
            $className = $matches[1];
        }

        if ($namespace && $className) {
            return $namespace.'\\'.$className;
        }

        return null;
    }

    /**
     * Check if a class is an Eloquent model
     */
    private static function isEloquentModel(string $className): bool
    {
        try {
            if (! class_exists($className)) {
                return false;
            }

            $reflection = new ReflectionClass($className);

            return ! $reflection->isAbstract()
                && $reflection->isSubclassOf(Model::class);
        } catch (Exception $exception) {
            return false;
        }
    }
}
