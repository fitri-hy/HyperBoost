<?php

namespace HyperBoost\Console;

use Illuminate\Console\Command;
use HyperBoost\Warmup\RouteWarmup;
use HyperBoost\Warmup\QueryWarmup;

class WarmupCommand extends Command
{
    protected $signature = 'hyper:warmup';
    protected $description = 'Warmup HyperBoost Cache';

    public function handle()
    {
        (new RouteWarmup())->warm();
        (new QueryWarmup())->warm();

        $this->info('Warmup Complete.');
    }
}
