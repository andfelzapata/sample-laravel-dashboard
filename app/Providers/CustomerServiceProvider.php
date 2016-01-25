<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register anything stripe customer related.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                           'App\GardenRevolution\Repositories\Contracts\CustomerRepositoryInterface',
                           'App\GardenRevolution\Repositories\CustomerRepository'
                       );
    }
}
