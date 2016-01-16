<?php namespace App\GardenRevolution\Forms\Profiles;

/*
 * Form to validate storing a profile.
 */

use App\GardenRevolution\Forms\Form;

class UpdateProfileForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|exists:profiles,id',
                'first_name'=>'sometimes|max:30',
                'last_name'=>'sometimes|max:30',
                'street_address'=>'sometimes|max:90',
                'apt_suite'=>'sometimes|max:8',
                'city'=>'sometimes|max:45',
                'state'=>'sometimes|min:2|max:2',
                'zip'=>'sometimes|min:5|max:5'
               ];        
    }
}
