<?php

declare(strict_types=1);

use App\Http\Controllers\Customer\TicketController;
use App\Http\Controllers\Ticket\TicketMessageController;
use Illuminate\Support\Facades\Route;

Route::middleware('customer')->group(function (): void {
    Route::resource('/tickets', TicketController::class);
    Route::get('/tickets/{ticket}/messages', [TicketMessageController::class, 'show']);
    Route::post('/tickets/{ticket}/messages', [TicketMessageController::class, 'store'])->name('message.post');
});
