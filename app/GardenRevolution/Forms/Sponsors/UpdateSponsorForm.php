<?php

namespace App\GardenRevolution\Forms\Sponsors;

use App\GardenRevolution\Forms\Form;

class UpdateSponsorForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'name'=>'required',
            'email'=>'required'
        ];
    }
}
