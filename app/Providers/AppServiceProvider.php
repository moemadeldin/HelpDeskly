<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\AuthServiceInterface;
use App\Interfaces\ImageManagerInterface;
use App\Interfaces\PasswordRecoveryServiceInterface;
use App\Interfaces\TicketManagerInterface;
use App\Services\AuthService;
use App\Services\ImageManager;
use App\Services\PasswordRecoveryService;
use App\Services\TicketManager;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );
        $this->app->bind(
            PasswordRecoveryServiceInterface::class,
            PasswordRecoveryService::class
        );
        $this->app->bind(
            ImageManagerInterface::class,
            ImageManager::class
        );
        $this->app->bind(
            TicketManagerInterface::class,
            TicketManager::class
        );
    }
}
