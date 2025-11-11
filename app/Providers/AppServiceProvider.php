<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\AuthServiceInterface;
use App\Interfaces\ProfileManagerInterface;
use App\Services\AuthService;
use App\Services\ProfileManager;
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
            ProfileManagerInterface::class,
            ProfileManager::class
        );
    }
}
