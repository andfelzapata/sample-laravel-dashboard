<?php namespace App\GardenRevolution\Forms\Users;

/*
 * Form to validate storing a user.
 */

use App\GardenRevolution\Forms\Form;

class StoreUserForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'email'=>'required|email|unique:users,email',
                'username'=>'required|unique:users,username',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required|same:password',
               ];        
    }
}
