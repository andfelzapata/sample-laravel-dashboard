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
                'id'=>'required|numeric|exists:users,id',
                'email'=>'sometimes|email|unique:users,email,'.$this->data['id'],
                'username'=>'sometimes|unique:users,username,'.$this->data['id'],
                'password'=>'sometimes|confirmed',
                'password_confirmation'=>'sometimes|same:password',
               ];        
    }
}
