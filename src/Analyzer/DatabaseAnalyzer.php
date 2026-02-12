<?php

namespace HyperBoost\Analyzer;

use Illuminate\Support\Facades\DB;

class DatabaseAnalyzer
{
    public function analyze(): array
    {
        $tables = DB::select('SHOW TABLES');
        $report = [];

        foreach ($tables as $table) {
            $name = array_values((array) $table)[0];
            $indexes = DB::select("SHOW INDEX FROM {$name}");

            $report[$name] = count($indexes);
        }

        return $report;
    }
}
