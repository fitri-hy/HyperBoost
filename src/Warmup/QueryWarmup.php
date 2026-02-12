<?php

namespace HyperBoost\Warmup;

use Illuminate\Support\Facades\DB;
use HyperBoost\Core\CacheManager;

class QueryWarmup
{
    public function warm(): void
    {
        CacheManager::rememberForever('hyper_db_tables', function () {
            return DB::select('SHOW TABLES');
        });
    }
}
