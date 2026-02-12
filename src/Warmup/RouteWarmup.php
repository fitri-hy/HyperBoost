<?php

namespace HyperBoost\Warmup;

use Illuminate\Support\Facades\Http;

class RouteWarmup
{
    public function warm(): void
    {
        foreach (config('hyperboost.warmup_routes', []) as $route) {
            try {
                Http::timeout(5)->get(url($route));
            } catch (\Throwable $e) {}
        }
    }
}
