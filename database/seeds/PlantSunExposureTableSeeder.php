<?php

use Illuminate\Database\Seeder;
use App\Models\PlantSunExposure;
use App\GardenRevolution\Repositories\Contracts\PlantSunExposureRepositoryInterface;

class PlantSunExposureTableSeeder extends Seeder
{	
	

	/**
	 * @var PlantSunExposureRepositoryInterface
	 */
	private $plantSunExposureRepository;

	public function __construct(PlantSunExposureRepositoryInterface $plantSunExposureRepository)
	{
		$this->plantSunExposureRepository = $plantSunExposureRepository;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantSunExposure::truncate();

        $sunExposures = [

        	'none',

        	'some', 

        	'full'
        	
        ];

        foreach($sunExposures as $exposure)
        {
            $this->plantSunExposureRepository->create([

                'exposure' => $exposure

            ]);
        }
    }
}
