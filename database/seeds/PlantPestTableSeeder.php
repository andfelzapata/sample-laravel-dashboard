<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Plant;
use App\Models\Pest;

class PlantPestTableSeeder extends Seeder
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

        $pestsId = Pest::lists('id')->toArray();

        foreach($plants as $plant)
        {
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
            $plant->pests()->attach($this->faker->randomElement($pestsId));
        }
    }
}
