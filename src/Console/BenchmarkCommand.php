<?php

namespace HyperBoost\Console;

use Illuminate\Console\Command;

class BenchmarkCommand extends Command
{
    protected $signature = 'hyper:benchmark';
    protected $description = 'Basic performance benchmark';

    public function handle()
    {
        $start = microtime(true);

        for ($i = 0; $i < 1000; $i++) {
            app()->make('config');
        }

        $time = microtime(true) - $start;

        $this->info("Benchmark Result: {$time} seconds");
    }
}
