<?php

namespace App\GardenRevolution\Notifications;

class NotifyView 
{
    const EMAIL_NEW_PLANT = 'emails.new.plant';
    const EMAIL_NEW_PROCED = 'emails.new.proced';
    const EMAIL_NEW_PEST = 'emails.new.pest';
    const EMAIL_NEW_TERM = 'emails.new.term';
    const EMAIL_NEW_CATEGORY = 'emails.new.category';
    const EMAIL_NEW_USER ='emails.new.user';

    const EMAIL_NEW_MODEL = 'emails.new.model';

    const EMAIL_REMIND_PASSWORD = 'emails.remind.password';
    const EMAIL_REMIND_USERNAME = 'emails.remind.username';

    const EMAIL_UPDATES = 'emails.updates';

    const EMAIL_WELCOME_USER = 'emails.welcome.user';

    //Instantiation not allowed
    final private function __construct() { }
}
