<?php

namespace App\Providers;

use App\Interfaces\CacheInterface;
use App\Services\CelebrityQuotes\CelebrityQuotesManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            CelebrityQuotesManager::class,
            fn (Application $app) => new CelebrityQuotesManager($app),
        );

        $this->app->singleton(
            CacheInterface::class,
            fn (Application $app) => app(Cache::class),
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
