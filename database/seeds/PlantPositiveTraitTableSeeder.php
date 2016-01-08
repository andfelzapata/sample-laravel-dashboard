<?php

use Illuminate\Database\Seeder;
use App\Models\PlantPositiveTrait;
use App\GardenRevolution\Repositories\Contracts\PlantPositiveTraitRepositoryInterface;

class PlantPositiveTraitTableSeeder extends Seeder
{
	
	/**
	 * @var PlantPositiveTraitRepository
	 */
	private $plantPositiveTraitRepository;

	public function __construct(PlantPositiveTraitRepositoryInterface $plantPositiveTraitRepository)
	{
		$this->plantPositiveTraitRepository = $plantPositiveTraitRepository;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantPositiveTrait::truncate();

        foreach(range(1,20) as $index)
        {
            $this->plantPositiveTraitRepository->create([

                'characteristic' => "Trait $index"

            ]);
        }

    }
}
