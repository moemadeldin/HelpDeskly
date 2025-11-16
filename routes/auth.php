<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketMessageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('me')
        ->controller(ProfileController::class)->group(function (): void {
            Route::get('', 'index')->name('profile.index');
            Route::put('', 'update')->name('profile.update');
            Route::delete('', 'destroy')->name('profile.destroy');
        });
    Route::resource('/tickets', TicketController::class);

    Route::get('/tickets/{ticket}/messages', [TicketMessageController::class, 'show']);
    Route::post('/tickets/{ticket}/messages', [TicketMessageController::class, 'store'])->name('message.post');
});
