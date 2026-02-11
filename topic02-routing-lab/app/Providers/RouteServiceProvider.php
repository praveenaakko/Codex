<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Post;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

final class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureRateLimiting();

        Route::bind('post', fn (string $value): Post => Post::query()->where('slug', $value)->firstOrFail());

        Route::model('comment', \App\Models\Comment::class);

        $this->routes(function (): void {
            Route::middleware('api')->group(base_path('routes/api.php'));
            Route::middleware('web')->group(base_path('routes/web.php'));
        });
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('api-v1', function (Request $request): Limit {
            return Limit::perMinute(30)->by((string) optional($request->user())->id ?: $request->ip());
        });

        RateLimiter::for('api-v2', function (Request $request): Limit {
            return Limit::perMinute(60)->by((string) optional($request->user())->id ?: $request->ip());
        });
    }
}
