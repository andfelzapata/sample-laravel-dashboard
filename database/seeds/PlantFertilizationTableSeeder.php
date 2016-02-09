<?php

use Illuminate\Database\Seeder;
use App\Models\PlantFertilization;
use App\GardenRevolution\Repositories\Contracts\PlantFertilizationRepositoryInterface;

class PlantFertilizationTableSeeder extends Seeder
{
    /**
     * @var PlantFertilizationRepository
     */
    private $plantFertilization;

    public function __construct(PlantFertilizationRepositoryInterface $plantFertilization)
    {
        $this->plantFertilization = $plantFertilization;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantFertilization::truncate();

        $fertilizations = [

            'none',

            'Fertilization 1',

            'Fertilization 2',

            'Fertilization 3',

            'Fertilization 4',

            'Fertilization 5',

        ];

        foreach($fertilizations as $fertilization)
        {
            $this->plantFertilization->create([

                'fertilization' => $fertilization

            ]);
        }
    }
}
