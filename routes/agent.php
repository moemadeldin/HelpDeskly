<?php

declare(strict_types=1);

use App\Http\Controllers\Agent\TicketController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/agent')
    ->middleware('agent')
    ->group(function (): void {
        Route::get('', DashboardController::class);
        Route::resource('tickets', TicketController::class)->names('dashboard.agent.tickets');
    });
