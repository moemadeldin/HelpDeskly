<?php

declare(strict_types=1);

use App\Http\Controllers\Agent\TicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Ticket\TicketMessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/agent')
    ->middleware('agent')
    ->group(function (): void {
        Route::get('', DashboardController::class);
        Route::resource('tickets', TicketController::class)->names('dashboard.agent.tickets');
        Route::controller(TicketMessageController::class)->group(function (): void {
            Route::get('/tickets/{ticket}/messages', 'show');
            Route::post('/tickets/{ticket}/messages', 'store')->name('dashboard.agent.message.post');
    });
    });
