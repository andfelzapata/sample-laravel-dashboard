<?php namespace App\GardenRevolution\Forms\Users;

use App\GardenRevolution\Forms\Form;

class GetUserForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric'
               ];        
    }
}
