<?php 


namespace App\GardenRevolution\Notifications;

/*
 * Class to output formatted action messages
 */
public class NotifyAction {
    public function added(string $entity) 
    {
        return 'new {$entity} is added';
    }

    public function reminder(string $attribute)
    {
        return '{$attribute} reminder';
    }

    public function general()
    {
        return 'news and updates';
    }
}
