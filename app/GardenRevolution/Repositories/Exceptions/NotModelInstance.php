<?php namespace App\GardenRevolution\Repositories\Exceptions;

use Exception;

/*
 * @author Alan Ruvalcaba
 * @since 2015-12-28
 */
class NotModelInstance extends Exception {
    function __construct() {
        parent::__construct('Model reference is not of type Illuminate\\Database\\Eloquent\\Model');
    }
}
