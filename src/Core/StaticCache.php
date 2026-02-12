<?php

namespace HyperBoost\Core;

class StaticCache
{
    protected static array $cache = [];

    public static function load(): void
    {
        $file = base_path('bootstrap/cache/hyper_static.php');

        if (file_exists($file)) {
            self::$cache = require $file;
        }
    }

    public static function get(string $key)
    {
        return self::$cache[$key] ?? null;
    }

    public static function set(array $data): void
    {
        file_put_contents(
            base_path('bootstrap/cache/hyper_static.php'),
            '<?php return '.var_export($data, true).';'
        );
    }
}
