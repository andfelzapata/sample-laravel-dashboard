<?php

namespace App\GardenRevolution\Notifications;

class NotifyView 
{
    const EMAIL_NEW_PLANT = 'email.new.plant';
    const EMAIL_NEW_PROCED = 'email.new.proced';
    const EMAIL_NEW_PEST = 'email.new.pest';
    const EMAIL_NEW_TERM = 'email.new.term';
    const EMAIL_NEW_CATEGORY = 'email.new.category';
    const EMAIL_NEW_USER ='email.new.user';

    const EMAIL_NEW_MODEL = 'email.new.model';

    const EMAIL_REMIND_PASSWORD = 'email.remind.password';
    const EMAIL_REMIND_USERNAME = 'email.remind.username';

    const EMAIL_UPDATES = 'email.updates';

    //Instantiation not allowed
    final private function __construct() { }
}
