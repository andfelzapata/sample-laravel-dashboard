<?php namespace App\GardenRevolution\Notifications;

/*
 * Describes the various notification conditions
 */
class NotifyCondition {
    const PUBLISHED = 'PUBLISHED';
    const TRIGGERED = 'TRIGGERED';

    //Instantiation not allowed
    final private function __construct() { }
}
