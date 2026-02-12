<?php

namespace HyperBoost\Console;

use Illuminate\Console\Command;
use HyperBoost\Compiler\ConfigCompiler;
use HyperBoost\Compiler\RouteCompiler;
use HyperBoost\Compiler\ContainerCompiler;
use HyperBoost\Compiler\PreloadGenerator;
use HyperBoost\Core\Integrity;

class CompileCommand extends Command
{
    protected $signature = 'hyper:compile';
    protected $description = 'Compile HyperBoost Optimization';

    public function handle()
    {
        $this->call('config:cache');
        $this->call('route:cache');
        $this->call('view:cache');
        $this->call('event:cache');

        (new ConfigCompiler())->compile();
        (new RouteCompiler())->compile();
        (new ContainerCompiler())->compile();
        (new PreloadGenerator())->generate();

        Integrity::generate();

        exec('composer dump-autoload -o');

        $this->info('HyperBoost Compilation Complete.');
    }
}
