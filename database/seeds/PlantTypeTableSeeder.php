<?php

use Illuminate\Database\Seeder;
use App\Models\PlantType;
use App\GardenRevolution\Repositories\Contracts\PlantTypeRepositoryInterface;

class PlantTypeTableSeeder extends Seeder
{

	/**
	 * @var PlantTypeRepository
	 */
	private $plantTypeRepository;

	public function __construct(PlantTypeRepositoryInterface $plantTypeRepository)
	{
		$this->plantTypeRepository = $plantTypeRepository;
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantType::truncate();

        $types = [

        	'normal',

        	'culinary'

        ];

        foreach($types as $type)
        {
        	$this->plantTypeRepository->create([
				
				'type' => $type

			]);
        }
    }
}
