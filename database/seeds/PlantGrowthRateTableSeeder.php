<?php

use Illuminate\Database\Seeder;
use App\Models\PlantGrowthRate;
use App\GardenRevolution\Repositories\Contracts\PlantGrowthRateRepositoryInterface;

class PlantGrowthRateTableSeeder extends Seeder
{

    /**
     * @var PlantGrowthRateRepositoryInterface
     */
    private $plantGrowthRateRepository;

    public function __construct(PlantGrowthRateRepositoryInterface $plantGrowthRateRepository)
    {
        $this->plantGrowthRateRepository = $plantGrowthRateRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantGrowthRate::truncate();

        $growthRates = [

            'slow',

            'stead',

            'fast'
        ];

        foreach($growthRates as $rate)
        {
            $this->plantGrowthRateRepository->create(
                [
                    'type' => $rate
                ]
            );
        }
    }
}
