<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Plant;
use App\Models\Procedure;

class PlantProcedureTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plants = Plant::all();

        $proceduresIds = Procedure::lists('id')->toArray();

        foreach($plants as $plant)
        {
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
            $plant->procedures()->attach($this->faker->randomElement($proceduresIds));
        }
    }
}
