<?php

namespace HyperBoost\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'hyper:install';
    protected $description = 'Install HyperBoost Enterprise';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'hyperboost-config'
        ]);

        $this->call('hyper:compile');
        $this->call('hyper:warmup');

        $this->info('HyperBoost Installed Successfully.');
    }
}
