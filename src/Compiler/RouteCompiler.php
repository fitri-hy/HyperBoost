<?php

namespace HyperBoost\Compiler;

use Illuminate\Support\Facades\Route;

class RouteCompiler
{
    public function compile(): void
    {
        $routes = [];

        foreach (Route::getRoutes() as $route) {
            $routes[] = [
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'action' => $route->getActionName(),
            ];
        }

        file_put_contents(
            base_path('bootstrap/cache/hyper_routes.php'),
            '<?php return '.var_export($routes, true).';'
        );
    }
}
