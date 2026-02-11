<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

final class RouteHealthController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'route_count' => count(Route::getRoutes()),
            'cache_path' => app()->getCachedRoutesPath(),
            'route_cache_exists' => file_exists(app()->getCachedRoutesPath()),
            'recommended_checks' => [
                'php artisan route:list',
                'php artisan route:cache',
            ],
            'last_optimize_status' => Artisan::output(),
        ]);
    }
}
