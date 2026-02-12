<?php

namespace HyperBoost\Core;

class EnvironmentDetector
{
    public static function detect(): string
    {
        if (!function_exists('shell_exec')) {
            return 'shared';
        }

        if (extension_loaded('redis')) {
            return 'vps';
        }

        if (ini_get('opcache.preload')) {
            return 'dedicated';
        }

        return 'vps';
    }
}
