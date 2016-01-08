<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PlantSunExposureServiceProvider extends ServiceProvider
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
            'App\GardenRevolution\Repositories\Contracts\PlantSunExposureRepositoryInterface',
            'App\GardenRevolution\Repositories\PlantSunExposureRepository'
        );
    }
}
