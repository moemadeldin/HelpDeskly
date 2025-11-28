<?php

declare(strict_types=1);

use App\Http\Controllers\Customer\TicketController;
use App\Http\Controllers\Ticket\TicketMessageController;
use Illuminate\Support\Facades\Route;

Route::middleware('customer')->group(function (): void {
    Route::resource('/tickets', TicketController::class);
    Route::controller(TicketMessageController::class)->group(function (): void {
        Route::get('/tickets/{ticket}/messages', 'show');
        Route::post('/tickets/{ticket}/messages', 'store')->name('message.post');
    });
});
