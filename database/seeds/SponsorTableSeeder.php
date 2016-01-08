<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Sponsor;
use App\GardenRevolution\Repositories\SponsorRepository;

class SponsorTableSeeder extends Seeder
{
    /**
     * @var SponsorRepository
     */
    private $sponsorRepository;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(SponsorRepository $sponsorRepository)
    {
        $this->sponsorRepository = $sponsorRepository;

        $this->faker = Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sponsor::truncate();

        foreach(range(1, 50) as $index)
        {
            $this->sponsorRepository->create(
                [
                    'name' => $this->faker->name,

                    'email' => $this->faker->email,

                    'url' => $this->faker->url,

                    'description' => $this->faker->realText(200),

                    'active_from' => $this->faker->date(),

                    'active_to' => date("Y-m-d H:i:s", strtotime("+ 1 year"))
                ]
            );
        }
    }
}
