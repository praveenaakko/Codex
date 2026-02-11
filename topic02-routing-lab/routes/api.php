<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\PostController as V1PostController;
use App\Http\Controllers\Api\V2\PostController as V2PostController;
use App\Http\Controllers\Api\V2\TenantCommentController;
use App\Http\Controllers\Api\V2\TenantPostController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->name('api.v1.')
    ->middleware(['api', 'throttle:api-v1'])
    ->group(function (): void {
        Route::apiResource('posts', V1PostController::class)
            ->scoped(['post' => 'slug']);
    });

Route::prefix('v2')
    ->name('api.v2.')
    ->middleware(['api', 'throttle:api-v2'])
    ->group(function (): void {
        Route::apiResource('posts', V2PostController::class)
            ->scoped(['post' => 'slug']);

        Route::domain('{tenant}.example.test')->group(function (): void {
            Route::middleware(['tenant.subdomain'])
                ->name('tenant.')
                ->group(function (): void {
                    Route::apiResource('posts', TenantPostController::class)
                        ->only(['index', 'show'])
                        ->scoped(['post' => 'slug']);

                    Route::apiResource('posts.comments', TenantCommentController::class)
                        ->only(['index', 'store'])
                        ->scoped(['post' => 'slug', 'comment' => 'uuid']);
                });
        });
    });
