<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Procedure;
use App\Models\Pest;

class ProcedurePestTableSeeder extends Seeder
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
        $procedures = Procedure::all();

        $pestsIds = Pest::lists('id')->toArray();

        foreach($procedures as $procedure)
        {
            $procedure->pests()->attach($this->faker->randomElement($pestsIds));
        }
    }
}
