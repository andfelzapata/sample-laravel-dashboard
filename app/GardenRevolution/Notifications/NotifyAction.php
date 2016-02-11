<?php 


namespace App\GardenRevolution\Notifications;

/*
 * Class to output formatted action messages
 */
public class NotifyAction {
    public static function added(string $entity) 
    {
        return 'new {$entity} is added';
    }

    public static function reminder(string $attribute)
    {
        return '{$attribute} reminder';
    }

    public static function general()
    {
        return 'news and updates';
    }
}
