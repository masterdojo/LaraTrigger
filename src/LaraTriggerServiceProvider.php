<?php

namespace Masterdojo\LaraTrigger;

use Illuminate\Support\ServiceProvider;

class LaraTriggerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'masterdojo');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'masterdojo');
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
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laratrigger.php', 'laratrigger');

        // Register the service the package provides.
        $this->app->singleton('laratrigger', function ($app) {
            return new LaraTrigger;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laratrigger'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laratrigger.php' => config_path('laratrigger.php'),
        ], 'laratrigger.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/masterdojo'),
        ], 'laratrigger.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/masterdojo'),
        ], 'laratrigger.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/masterdojo'),
        ], 'laratrigger.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
