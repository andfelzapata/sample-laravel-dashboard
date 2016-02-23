<?php

namespace App\Jobs;

use App\Jobs\AddedNotification;
use App\Jobs\WelcomeNotification;

class JobFactory {
    public function newAddedNotificationInstance(array $data)
    {
        return new AddedNotification($data);
    }

    public function newWelcomeNotificationInstance(array $data)
    {
        return new WelcomeNotification($data);
    }
}
