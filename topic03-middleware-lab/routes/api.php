<?php

declare(strict_types=1);

use App\Http\Controllers\Api\PipelineOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('pipeline')
    ->middleware(['api', 'correlation.id', 'api.key', 'idempotency'])
    ->group(function (): void {
        Route::post('/orders', PipelineOrderController::class)
            ->name('pipeline.orders.store');
    });
