<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StateServiceProvider extends ServiceProvider
{
    /**
     * Register anything user related.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                           'App\GardenRevolution\Repositories\Contracts\StateRepositoryInterface',
                           'App\GardenRevolution\Repositories\StateRepository'
                       );
    }
}
