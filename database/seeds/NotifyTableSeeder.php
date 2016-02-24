<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

use App\GardenRevolution\Notifications\NotifyView;
use App\GardenRevolution\Notifications\NotifyAction;
use App\GardenRevolution\Notifications\NotifyCondition;

use App\GardenRevolution\Repositories\Contracts\NotificationRepositoryInterface;

class NotifyTableSeeder extends Seeder
{
    private $faker;

    public function __construct
    (
        NotificationRepositoryInterface $notificationRepository
    )
    {
        $this->notificationRepository = $notificationRepository;
        $this->faker = Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notifications = array(
            array(
                'action'=> NotifyAction::added('plant'),
                'condition'=> NotifyCondition::PUBLISHED,
                'content'=> NotifyView::EMAIL_NEW_PLANT,
                'status'=> true
            ),
            array(
                'action'=> NotifyAction::added('procedure'),
                'condition'=> NotifyCondition::PUBLISHED,
                'content'=> NotifyView::EMAIL_NEW_PROCED,
                'status'=> true
            ),
            array(
                'action'=> NotifyAction::added('pest'),
                'condition'=> NotifyCondition::PUBLISHED,
                'content'=> NotifyView::EMAIL_NEW_PEST,
                'status'=> true
            ),
            array(
                'action'=> NotifyAction::added('user'),
                'condition'=> NotifyCondition::PUBLISHED,
                'content'=> NotifyView::EMAIL_WELCOME_USER,
                'status'=> true
            ),
            array(
                'action'=> NotifyAction::general(),
                'condition'=> NotifyCondition::PUBLISHED,
                'content'=> NotifyView::EMAIL_UPDATES,
                'status'=> false
            ),

            array(
                'action'=> NotifyAction::reminder('password'),
                'condition'=> NotifyCondition::TRIGGERED,
                'content'=> NotifyView::EMAIL_REMIND_PASSWORD,
                'status'=> false
            ),

            array(
                'action'=> NotifyAction::reminder('username'),
                'condition'=> NotifyCondition::TRIGGERED,
                'content'=> NotifyView::EMAIL_REMIND_USERNAME,
                'status'=> false
            )
        );

        foreach($notifications as $notification)
        {
            $this->notificationRepository->create($notification);
        }
    }
}
