<?php

namespace HOTSAUCEJAKE\LaravelSleeper;

use Illuminate\Support\ServiceProvider;

class LaravelSleeperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $source = realpath(__DIR__ . '/../config/sleeper.php');

        $this->publishes([$source => config_path('sleeper.php')]);

        $this->mergeConfigFrom($source, 'sleeper');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->bind(BrexApi::class, function () {
            return new LaravelSleeper();
        });

        $this->app->alias(LaravelSleeper::class, 'laravel-sleeper');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [LaravelSleeper::class];
    }
}
