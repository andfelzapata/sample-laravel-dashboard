<?php namespace App\GardenRevolution\Forms\Users;

/*
 * Form to validate user delete.
 */

use App\GardenRevolution\Forms\Form;

class DeleteUserForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric|exists:users,id'
               ];        
    }
}
