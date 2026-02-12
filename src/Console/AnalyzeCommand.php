<?php

namespace HyperBoost\Console;

use Illuminate\Console\Command;
use HyperBoost\Analyzer\DatabaseAnalyzer;

class AnalyzeCommand extends Command
{
    protected $signature = 'hyper:analyze';
    protected $description = 'Analyze Database Structure';

    public function handle()
    {
        $report = (new DatabaseAnalyzer())->analyze();

        foreach ($report as $table => $indexCount) {
            $this->info("Table: {$table} | Indexes: {$indexCount}");
        }
    }
}
