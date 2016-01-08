<?php

use Illuminate\Database\Seeder;
use App\Models\PlantMaintenance;
use App\GardenRevolution\Repositories\Contracts\PlantMaintenanceRepositoryInterface;

class PlantMaintenanceTableSeeder extends Seeder
{
	
	/**
	 * @var PlantMaintenanceRepositoryInterface
	 */
	private $plantMaintenanceRepository;

	public function __construct(PlantMaintenanceRepositoryInterface $plantMaintenanceRepository)
	{
		$this->plantMaintenanceRepository = $plantMaintenanceRepository;
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantMaintenance::truncate();

        $maintenances = [

        	'low', 

        	'moderate',

        	'high'

        ];

        foreach ($maintenances as $maintenance) 
        {
        	$this->plantMaintenanceRepository->create([

        		'maintenance' => $maintenance

			]);
        }
    }
}
