<?php namespace App\GardenRevolution\Forms\Pests;

use App\GardenRevolution\Forms\Form;

class UpdatePestForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'common_name' => 'required',

            'latin_name' => 'required'
        ];
    }
}
