<?php

namespace HyperBoost\Compiler;

class ConfigCompiler
{
    public function compile(): void
    {
        $config = config()->all();

        file_put_contents(
            base_path('bootstrap/cache/hyper_config.php'),
            '<?php return '.var_export($config, true).';'
        );
    }
}
