<?php namespace App\GardenRevolution\Forms\Users;

/*
 * @author Alan Ruvalcaba
 * @since 01-08-2016
 * Form to validate storing a user.
 */

use App\GardenRevolution\Forms\Form;

class StoreUserForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'email'=>'required|email|unique:users,email',
                'username'=>'required|unique:users,username'
               ];        
    }
}
