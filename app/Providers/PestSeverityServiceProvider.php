<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PestSeverityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\GardenRevolution\Repositories\Contracts\PestSeveritiesRepositoryInterface',
            'App\GardenRevolution\Repositories\PestSeveritiesRepository'
        );
    }
}
