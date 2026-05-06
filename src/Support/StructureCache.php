<?php

namespace UJCMOK\FilamentExportableApiPlugin\Support;

use Illuminate\Support\Facades\Cache;

class StructureCache
{
    public static function remember(string $key, callable $callback)
    {
        if (!config('filament-exportable.cache.enabled')) {
            return $callback();
        }

        return Cache::remember(
            $key,
            config('filament-exportable.cache.ttl'),
            $callback
        );
    }
}
