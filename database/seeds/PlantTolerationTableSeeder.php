<?php

use Illuminate\Database\Seeder;
use App\Models\PlantToleration;
use App\GardenRevolution\Repositories\Contracts\PlantTolerationRepositoryInterface;

class PlantTolerationTableSeeder extends Seeder
{

	/**
	 * @var PlantTolerationRepository
	 */
	private $plantTolerationRepository;
	
	public function __construct(PlantTolerationRepositoryInterface $plantTolerationRepository)
	{
		$this->plantTolerationRepository = $plantTolerationRepository;
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantToleration::truncate();

        foreach(range(1,20) as $index)
        {
            $this->plantTolerationRepository->create([

                'toleration' => "Toleration $index"

            ]);
        }
    }
}
