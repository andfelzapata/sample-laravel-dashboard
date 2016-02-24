<?php

use Illuminate\Database\Seeder;
use App\Models\PlantNegativeTrait;
use App\GardenRevolution\Repositories\Contracts\PlantNegativeTraitRepositoryInterface;

class PlantNegativeTraitTableSeeder extends Seeder
{
	
	/**
	 * @var PlantNegativeRepository
	 */
	private $plantNegativeTraitRepository;

	public function __construct(PlantNegativeTraitRepositoryInterface $plantNegativeTraitRepository)
	{
		$this->plantNegativeTraitRepository = $plantNegativeTraitRepository;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantNegativeTrait::truncate();

        foreach(range(1,20) as $index)
        {
        	$this->plantNegativeTraitRepository->create([

				'characteristic' => "Trait $index"

			]);
        }

    }
}
