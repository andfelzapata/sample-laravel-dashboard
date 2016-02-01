<?php

use Illuminate\Database\Seeder;
use App\Models\AlertUrgency;
use App\GardenRevolution\Repositories\Contracts\AlertUrgenciesRepositoryInterface;

class AlertUrgenciesTableSeeder extends Seeder
{
    /**
     * @var AlertUrgenciesRepositoryInterface
     */
    private $alertUrgencyRepository;

    public function __construct(AlertUrgenciesRepositoryInterface $alertUrgenciesRepository)
    {
        $this->alertUrgencyRepository = $alertUrgenciesRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AlertUrgency::truncate();

        $alertUrgencyRepository = [

            'none',

            'optional',

            'mandatory'

        ];

        foreach($alertUrgencyRepository as $urgency)
        {
            $this->alertUrgencyRepository->create([

                'urgency' => $urgency

            ]);
        }
    }
}
