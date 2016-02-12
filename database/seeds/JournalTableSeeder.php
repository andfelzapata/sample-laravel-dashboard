<?php

use Illuminate\Database\Seeder;
use App\Models\Journal;
use App\Models\JournalStatus;
use App\Models\User;
use App\Models\Plant;
use App\Models\Pest;
use App\Models\Procedure;
use App\Models\Alert;
use Faker\Factory;
use App\GardenRevolution\Repositories\Contracts\JournalRepositoryInterface;

class JournalTableSeeder extends Seeder
{
    /**
     * @var JournalRepositoryInterface
     */
    private $journal;

    /**
     * @var
     */
    private $faker;

    public function __construct(JournalRepositoryInterface $journalRepository)
    {
        $this->faker = Factory::create();

        $this->journal = $journalRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Journal::truncate();

        $journalStatus = JournalStatus::lists('id')->toArray();

        $usersId  = User::lists('id')->toArray();

        $plantsId = Plant::lists('id')->toArray();

        $pestsId = Pest::lists('id')->toArray();

        $procedureId = Procedure::lists('id')->toArray();

        $alertsId = Alert::lists('id')->toArray();

        foreach(range(1,200) as $index)
        {
            $this->journal->create([

                'user_id' => $this->faker->randomElement($usersId),

                'status_id' => $this->faker->randomElement($journalStatus),

                'plant_id' => $this->faker->randomElement($plantsId),

                'pest_id' => $this->faker->randomElement($pestsId),

                'procedure_id' => $this->faker->randomElement($procedureId),

                'alert_id' => $this->faker->randomElement($alertsId),

                'title' => $this->faker->sentence(),

                'content' => $this->faker->realText()

            ]);
        }
    }
}
