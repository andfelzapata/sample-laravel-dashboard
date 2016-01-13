<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\GardenRevolution\Validators\CustomValidators;

/*
 * Class to resolve custom validation
 */
class ValidationServiceProvider extends ServiceProvider {
    public function boot()
    {
        $this->app->validator->resolver(function($translator,$data,$rules,$messages)
        {
            return new CustomValidators($translator,$data,$rules,$messages);
        });
    }

    //Must be declared
    public function register()
    {

    }
}
