<?php

namespace App\Providers;

use App\Interfaces\PlayerClassInterface;
use App\Interfaces\PlayerInterface;
use App\Interfaces\RpgSessionInterface;
use App\Models\PlayerClass;
use App\Observers\RpgSessionObserver;
use App\Repositories\PlayerClassRepository;
use App\Repositories\PlayerRepository;
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
