<?php

declare(strict_types=1);

use App\Http\Controllers\Api\CreateOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function (): void {
    Route::post('/orders', CreateOrderController::class)
        ->name('orders.store');
});
