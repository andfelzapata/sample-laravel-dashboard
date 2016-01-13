<?php namespace App\GardenRevolution\Forms\Users;

/*
 * Form to validate updating a user.
 */

use App\GardenRevolution\Forms\Form;

class UpdateUserForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric',
                'email'=>'required|email|unique:users,email,'.$this->data['id'],
                'username'=>'not'
               ];        
    }
}
