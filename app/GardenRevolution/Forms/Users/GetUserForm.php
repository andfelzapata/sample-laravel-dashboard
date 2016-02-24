<?php namespace App\GardenRevolution\Forms\Users;

/*
 * Form to validate user retrieval.
 */

use App\GardenRevolution\Forms\Form;

class GetUserForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric|exists:users,id'
               ];        
    }
}
