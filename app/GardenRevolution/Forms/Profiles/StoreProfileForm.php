<?php namespace App\GardenRevolution\Forms\Profiles;

/*
 * Form to validate storing a profile.
 */

use App\GardenRevolution\Forms\Form;

class StoreProfileForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'user_id'=>'required|exists:users,id',
                'first_name'=>'required|max:30',
                'last_name'=>'required|max:30',
                'street_address'=>'sometimes|max:90',
                'apt_suite'=>'sometimes|max:8',
                'city'=>'sometimes|max:45',
                'state'=>'sometimes|min:2|max:2',
                'zip'=>'sometimes|min:5|max:5'
               ];        
    }
}
