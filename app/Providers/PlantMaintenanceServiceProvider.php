<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PlantMaintenanceServiceProvider extends ServiceProvider
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
            'App\GardenRevolution\Repositories\Contracts\PlantMaintenanceRepositoryInterface',
            'App\GardenRevolution\Repositories\PlantMaintenanceRepository'
        );
    }
}
