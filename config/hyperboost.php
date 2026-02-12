<?php

return [

    'enabled' => env('HYPERBOOST_ENABLED', true),

    'environment' => 'auto',

    'warmup_routes' => [
        '/',
    ],

    'cache_path' => 'bootstrap/cache',

    'integrity_hash' => true,

];
