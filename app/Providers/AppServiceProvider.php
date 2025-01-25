<?php

namespace App\Providers;

use App\Interfaces\Repositories\PlayerClassInterface;
use App\Interfaces\Repositories\PlayerInterface;
use App\Interfaces\Repositories\PlayerSessionInterface;
use App\Interfaces\Repositories\RpgSessionInterface;
use App\Observers\RpgSessionObserver;
use App\Repositories\PlayerClassRepository;
use App\Repositories\PlayerRepository;
use App\Repositories\PlayerSessionRepository;
use App\Repositories\RpgSessionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PlayerInterface::class, PlayerRepository::class);
        $this->app->bind(PlayerClassInterface::class, PlayerClassRepository::class);
        $this->app->bind(PlayerSessionInterface::class, PlayerSessionRepository::class);
        $this->app->bind(RpgSessionInterface::class, RpgSessionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\RpgSession::observe(RpgSessionObserver::class);
    }
}
