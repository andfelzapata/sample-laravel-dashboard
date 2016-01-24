<?php

use Illuminate\Database\Seeder;
use App\Models\PestSeverity;
use App\GardenRevolution\Repositories\Contracts\PestSeveritiesRepositoryInterface;

class PestSeveritiesTableSeeder extends Seeder
{
    private $pestSeverity;

    public function __construct(PestSeveritiesRepositoryInterface $pestSeveritiesRepository)
    {
        $this->pestSeverity = $pestSeveritiesRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PestSeverity::truncate();

        $pestSeverities = [
            'none',

            'minor',

            'mild',

            'severe'
        ];

        foreach($pestSeverities as $severity)
        {
            $this->pestSeverity->create([

                'severity' => $severity

            ]);
        }
    }
}
