<?php

namespace App\GardenRevolution\Forms\CulinaryPlants;

/*
 * Form to validate storing a culinary plant.
 */

use App\GardenRevolution\Forms\Form;

class StoreCulinaryPlantForm extends Form
{
    public function getPreparedRules()
    {
        return [
            'common_name'=>'required',
            'botanical_name'=>'required'
        ];
    }
}
