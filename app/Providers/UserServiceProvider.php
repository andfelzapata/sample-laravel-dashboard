<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register anything user related.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                           'App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',
                           'App\GardenRevolution\Repositories\UserRepository'
                       );

        $this->app->bind(
                           'App\GardenRevolution\Repositories\Contracts\ProfileRepositoryInterface',
                           'App\GardenRevolution\Repositories\ProfileRepository'
                       );

        $this->app->bind(
                           'App\GardenRevolution\Repositories\Contracts\SettingsRepositoryInterface',
                           'App\GardenRevolution\Repositories\SettingsRepository'
                       );
  
        $this->app->bind(
                           'App\GardenRevolution\Repositories\Contracts\PaymentRepositoryInterface',
                           'App\GardenRevolution\Repositories\PaymentRepository'
                       );
    }
}
