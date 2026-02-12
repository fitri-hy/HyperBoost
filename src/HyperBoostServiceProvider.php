<?php

namespace HyperBoost;

use Illuminate\Support\ServiceProvider;

class HyperBoostServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/hyperboost.php',
            'hyperboost'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/hyperboost.php' => config_path('hyperboost.php'),
        ], 'hyperboost-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
                Console\CompileCommand::class,
                Console\WarmupCommand::class,
                Console\AnalyzeCommand::class,
                Console\BenchmarkCommand::class,
            ]);
        }
    }
}
