<?php

use Illuminate\Database\Seeder;
use App\Models\Soil;
use App\GardenRevolution\Repositories\Contracts\SoilRepositoryInterface;

class SoilTableSeeder extends Seeder
{
    /**
     * @var SoilRepository
     */
    private $soilRepository;

    public function __construct(SoilRepositoryInterface $soilRepository)
    {
        $this->soilRepository = $soilRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Soil::truncate();

        $soils = [

            'Neutral Alkaline',

            'Well Drained',

            'Clay',

            'Silty',

            'Loamy',

            'Sandy',

            'Peaty',

            'Saline',

            'Chalky'
        ];

        foreach($soils as $soil) {

            $this->soilRepository->create([

                'soil_type' => $soil,

            ]);
        }
    }
}
