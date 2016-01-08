<?php

use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\GardenRevolution\Repositories\Contracts\ZoneRepositoryInterface;

class ZoneTableSeeder extends Seeder
{
	
	/**
	 * @var ZoneRepository
	 */
	private $zoneRepository;

	public function __construct(ZoneRepositoryInterface $zoneRepository)
	{
		$this->zoneRepository = $zoneRepository;
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zone::truncate();

		foreach(range(1, 13) as $index)
		{
			$this->zoneRepository->create([

				'zone' => "{$index}a"
			]);

			$this->zoneRepository->create([

				'zone' => "{$index}b"
			]);
		}
    }
}

