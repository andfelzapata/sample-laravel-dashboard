<?php

use Illuminate\Database\Seeder;
use App\Models\Alert;
use App\Models\Zone;
use App\Models\AlertUrgency;
use App\Models\Plant;
use App\Models\Procedure;
use App\GardenRevolution\Repositories\Contracts\AlertRepositoryInterface;
use Faker\Factory;

class AlertTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var AlertRepositoryInterface
     */
    private $alert;

    public function __construct(AlertRepositoryInterface $alertRepository)
    {
        $this->faker = Factory::create();

        $this->alert = $alertRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alert::truncate();

        $plantsId = Plant::lists('id')->toArray();

        $proceduresId = Procedure::lists('id')->toArray();

        $zonesId = Zone::lists('id')->toArray();

        $alertUrgenciesId = AlertUrgency::lists('id')->toArray();

        foreach(range(1,50) as $index)
        {
            $start = rand(1,12);

            $this->alert->create([

                'name' => $this->faker->word() . ' Alert',

                'zone_id' => $this->faker->randomElement($zonesId),

                'alert_urgency_id' => $this->faker->randomElement($alertUrgenciesId),

                'procedure_id' => $this->faker->randomElement($proceduresId),

                'plant_id' => $this->faker->randomElement($plantsId),

                'start_date' => date('Y-m-d H:i:s', strtotime("-$start month")),

                'end_date' => date('Y-m-d H:i:s', strtotime("last month"))

            ]);
        }
    }
}
