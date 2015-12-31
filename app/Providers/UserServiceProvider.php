<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    protected $defer = true;

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
    }
}
