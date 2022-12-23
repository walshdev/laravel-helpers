<?php

namespace Walshdev\LaravelHelpers;

use Illuminate\Support\ServiceProvider;

class LaravelHelpersServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'walshdev');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'walshdev');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-helpers.php', 'laravel-helpers');

        // Register the service the package provides.
        $this->app->singleton('laravel-helpers', function ($app) {
            return new LaravelHelpers;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-helpers'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-helpers.php' => config_path('laravel-helpers.php'),
        ], 'laravel-helpers.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/walshdev'),
        ], 'laravel-helpers.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/walshdev'),
        ], 'laravel-helpers.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/walshdev'),
        ], 'laravel-helpers.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
