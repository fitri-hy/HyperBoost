<?php

namespace HyperBoost\Compiler;

class ContainerCompiler
{
    public function compile(): void
    {
        $bindings = app()->getBindings();
        $compiled = [];

        foreach ($bindings as $abstract => $binding) {
            if ($binding['shared']) {
                $compiled[$abstract] = $binding['concrete'];
            }
        }

        file_put_contents(
            base_path('bootstrap/cache/hyper_container.php'),
            '<?php return '.var_export($compiled, true).';'
        );
    }
}
