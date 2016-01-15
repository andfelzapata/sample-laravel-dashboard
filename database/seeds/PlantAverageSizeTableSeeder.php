<?php

use Illuminate\Database\Seeder;
use App\Models\PlantAverageSize;
use App\GardenRevolution\Repositories\Contracts\PlantAverageSizeRepositoryInterface;

class PlantAverageSizeTableSeeder extends Seeder
{

    /**
     * @var PlantAverageSizeRepositoryInterface
     */
    private $plantAverageSizeRepository;

    public function __construct(PlantAverageSizeRepositoryInterface $plantAverageSizeRepository)
    {
        $this->plantAverageSizeRepository = $plantAverageSizeRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantAverageSize::truncate();

        $plantSizes = [
            'none',

            'small',

            'medium',

            'large'
        ];

        foreach($plantSizes as $size)
        {
            $this->plantAverageSizeRepository->create([

                'size' => $size

            ]);
        }
    }
}
