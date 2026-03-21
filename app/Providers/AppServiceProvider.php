<?php

namespace App\Providers;

use App\Repository\Setting\SettingRepository;
use App\Repository\Setting\SettingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
    }
}