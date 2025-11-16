<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/admin')
    ->middleware('admin')
    ->group(function (): void {
        Route::view('', 'dashboard.layout');
        Route::resource('categories', CategoryController::class)->names([
            'index' => 'dashboard.categories.index',
            'create' => 'dashboard.categories.create',
            'store' => 'dashboard.categories.store',
            'show' => 'dashboard.categories.show',
            'edit' => 'dashboard.categories.edit',
            'update' => 'dashboard.categories.update',
            'destroy' => 'dashboard.categories.destroy',
        ]);
        Route::resource('tickets', TicketController::class)->names([
            'index' => 'dashboard.tickets.index',
            'create' => 'dashboard.tickets.create',
            'store' => 'dashboard.tickets.store',
            'show' => 'dashboard.tickets.show',
            'edit' => 'dashboard.tickets.edit',
            'update' => 'dashboard.tickets.update',
            'destroy' => 'dashboard.tickets.destroy',
        ]);
    });
