<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')
    ->middleware('agent')
    ->group(function (): void {
        Route::view('', 'dashboard.layout');
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
