<?php namespace App\GardenRevolution\Forms\Procedures;

use App\GardenRevolution\Forms\Form;

class UpdateProcedureForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'common_name' => 'required',

            'latin_name' => 'required'
        ];
    }
}
