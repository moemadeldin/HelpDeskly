<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/admin')
    ->middleware('admin')
    ->group(function (): void {
        Route::get('', DashboardController::class);
        Route::resource('categories', CategoryController::class)->names('dashboard.categories');
        Route::resource('tickets', TicketController::class)->names('dashboard.tickets');
    });
