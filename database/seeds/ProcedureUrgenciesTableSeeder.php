<?php

use Illuminate\Database\Seeder;
use App\Models\ProcedureUrgency;
use App\GardenRevolution\Repositories\Contracts\ProcedureUrgenciesRepositoryInterface;

class ProcedureUrgenciesTableSeeder extends Seeder
{
    private $procedureUrgency;

    public function __construct(ProcedureUrgenciesRepositoryInterface $procedureUrgenciesRepository)
    {
        $this->procedureUrgency = $procedureUrgenciesRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcedureUrgency::truncate();

        $procedureUrgencies = [

            'none',

            'low',

            'medium',

            'high'

        ];

        foreach($procedureUrgencies as $urgency)
        {
            $this->procedureUrgency->create([

                'urgency' => $urgency

            ]);
        }
    }
}
