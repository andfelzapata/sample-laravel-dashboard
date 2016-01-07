<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * Default factory for Sponsor model.
 */
$factory->define(App\Models\Sponsor::class, function(Faker\Generator $faker) {
   return [
       'name' => $faker->name,
       'email' => $faker->email,
       'url' => $faker->url,
       'description' => $faker->realText($maxNbChars = 200),
       'active_from' => $faker->dateTime($max = 'now'),
       'active_to' => date("Y-m-d H:i:s", strtotime('+ 1 year')),
   ];
});

