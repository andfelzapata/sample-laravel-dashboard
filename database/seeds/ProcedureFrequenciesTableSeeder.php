<?php

use Illuminate\Database\Seeder;
use App\GardenRevolution\Repositories\Contracts\ProcedureFrequenciesRepositoryInterface;
use App\Models\ProcedureFrequency;

class ProcedureFrequenciesTableSeeder extends Seeder
{

    /**
     * @var ProcedureFrequenciesRepositoryInterface
     */
    private $frequenciesRepository;

    public function __construct(ProcedureFrequenciesRepositoryInterface $frequenciesRepository)
    {
        $this->frequenciesRepository = $frequenciesRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcedureFrequency::truncate();

        $procedureFrequencies = [

            'none',

            'daily',

            'weekly',

            'monthly'
        ];

        foreach($procedureFrequencies as $frequency)
        {
            $this->frequenciesRepository->create([

                'frequency' => $frequency

            ]);
        }
    }
}
