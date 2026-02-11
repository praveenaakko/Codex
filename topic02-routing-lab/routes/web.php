<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\RouteHealthController;
use App\Http\Controllers\Web\InviteAcceptanceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'can:viewRouteHealth'])
    ->prefix('internal')
    ->name('internal.')
    ->group(function (): void {
        Route::get('/route-health', RouteHealthController::class)->name('route-health');
    });

Route::get('/invites/{invite}', InviteAcceptanceController::class)
    ->name('invites.accept')
    ->middleware('signed');
