<?php namespace App\GardenRevolution\Forms\CulinaryPlants;

use App\GardenRevolution\Forms\Form;

class UpdateCulinaryPlantForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'common_name'=>'required',
            'botanical_name'=>'required'
        ];
    }
}
