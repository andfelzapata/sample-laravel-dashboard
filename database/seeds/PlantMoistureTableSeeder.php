<?php

use Illuminate\Database\Seeder;
use App\Models\PlantMoisture;
use App\GardenRevolution\Repositories\Contracts\PlantMoistureRepositoryInterface;

class PlantMoistureTableSeeder extends Seeder
{
    /**
     * @var PlantMoistureRepository
     */
    private $plantMoisture;

    public function __construct(PlantMoistureRepositoryInterface $plantMoisture)
    {
        $this->plantMoisture = $plantMoisture;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantMoisture::truncate();

        $this->plantMoisture->create([

            'moisture' => 0

        ]);

        foreach(range(1,5) as $index)
        {
            $this->plantMoisture->create([

                'moisture' => $index

            ]);
        }
    }
}
