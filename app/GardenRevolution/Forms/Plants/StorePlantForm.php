<?php

namespace App\GardenRevolution\Forms\Plants;

/*
 * Form to validate storing a plant.
 */

use App\GardenRevolution\Forms\Form;

class StorePlantForm extends Form
{
    public function getPreparedRules()
    {
        return [
            'common_name'=>'required',
            'botanical_name'=>'required'
        ];
    }
}
