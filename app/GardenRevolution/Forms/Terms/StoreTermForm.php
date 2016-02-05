<?php

namespace App\GardenRevolution\Forms\Terms;

/*
 * Form to validate storing a plant.
 */

use App\GardenRevolution\Forms\Form;

class StoreTermForm extends Form
{
    public function getPreparedRules()
    {
        return [
            'name'=>'required|unique:terms,name|max:32',
            'description'=>'required|max:140'
        ];
    }
}
