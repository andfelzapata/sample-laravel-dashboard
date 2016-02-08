<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlossaryServiceProvider extends ServiceProvider
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
            'App\GardenRevolution\Repositories\Contracts\GlossaryRepositoryInterface',
            'App\GardenRevolution\Repositories\GlossaryRepository'
        );
    }
}
