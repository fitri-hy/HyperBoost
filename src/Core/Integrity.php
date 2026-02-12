<?php

namespace HyperBoost\Core;

class Integrity
{
    public static function generate(): void
    {
        $hash = hash_file('sha256', base_path('composer.lock'));

        file_put_contents(
            base_path('bootstrap/cache/hyper_integrity.hash'),
            $hash
        );
    }

    public static function validate(): bool
    {
        $file = base_path('bootstrap/cache/hyper_integrity.hash');

        if (!file_exists($file)) {
            return false;
        }

        $current = hash_file('sha256', base_path('composer.lock'));
        $stored = file_get_contents($file);

        return $current === $stored;
    }
}
