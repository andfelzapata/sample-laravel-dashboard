<?php

namespace App\GardenRevolution\Validators;

use Illuminate\Validation\Validator;

class CustomValidators extends Validator {
    public function validateNot($field, $value, $params) {
        try 
        {
            return is_null($value) ? true : false;
        }

        catch(Exception $e) 
        {
            return false;
        }
    }
}
