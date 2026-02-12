<?php

namespace HyperBoost\Compiler;

class PreloadGenerator
{
    public function generate(): void
    {
        $content = "<?php\n";

        foreach (get_declared_classes() as $class) {
            try {
                $ref = new \ReflectionClass($class);
                if ($file = $ref->getFileName()) {
                    $content .= "opcache_compile_file('{$file}');\n";
                }
            } catch (\Throwable $e) {}
        }

        file_put_contents(
            base_path('bootstrap/cache/hyper_preload.php'),
            $content
        );
    }
}
