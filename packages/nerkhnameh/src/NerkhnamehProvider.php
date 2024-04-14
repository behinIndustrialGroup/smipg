<?php

namespace Mkhodroo\Nerkhnameh;

use Illuminate\Support\ServiceProvider;

class NerkhnamehProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadViewsFrom(__DIR__ . '/Views', 'NerkhnamehView');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadJsonTranslationsFrom(__DIR__ .'/Lang');
        $this->publishes([
            __DIR__ . '/public' => public_path('/packages/nerkhnameh'),
            __DIR__ . '/nerkhnameh_config.php' => config_path('nerkhnameh_config.php')
        ]);
    }
}
