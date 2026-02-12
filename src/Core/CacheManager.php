<?php

namespace HyperBoost\Core;

use Illuminate\Support\Facades\Cache;

class CacheManager
{
    public static function driver(): string
    {
        return config('cache.default');
    }

    public static function rememberForever(string $key, callable $callback)
    {
        return Cache::rememberForever($key, $callback);
    }
}
