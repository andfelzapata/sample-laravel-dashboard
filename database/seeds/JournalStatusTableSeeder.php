<?php

use Illuminate\Database\Seeder;
use App\Models\JournalStatus;
use App\GardenRevolution\Repositories\Contracts\JournalStatusRepositoryInterface;

class JournalStatusTableSeeder extends Seeder
{
    /**
     * @var JournalStatusRepository
     */
    private $journalStatus;

    public function __construct(JournalStatusRepositoryInterface $journalStatusRepository)
    {
        $this->journalStatus = $journalStatusRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JournalStatus::truncate();

        $journalStatus = [

            'Published',

            'Suspended',

            'Trashed',

            'Draft',

            'Other Status'
        ];

        foreach($journalStatus as $status)
        {
            $this->journalStatus->create([

                'status' => $status

            ]);
        }
    }
}
