<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ResponderServiceProvider extends ServiceProvider
{
    /**
     * Register anything responder related.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                           'App\GardenRevolution\Responders\Admin\Contracts\UsersResponderInterface',
                           'App\GardenRevolution\Responders\Admin\UsersResponder'
                        );
    }
}
