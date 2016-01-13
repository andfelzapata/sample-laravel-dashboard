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
                'password'=>'confirmed',
                'password_confirmation'=>'same:password',
                'first_name'=>'required_with: last_name',
                'last_name'=>'required_with: first_name',
                'apt_suite'=>'required_with: street_address,city,state,zip',
                'zip'=>'min: 5|required_with: street_address,city,state,apt_suite',
                'city'=>'required_with: street_address,state,apt_suite,zip',
                'state'=>'required_with: street_address,apt_suite,zip,city',
                'street_address'=>'required_with: apt_suite, city, state, zip'
               ];        
    }
}
