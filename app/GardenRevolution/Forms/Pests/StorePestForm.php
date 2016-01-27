<?php

namespace App\GardenRevolution\Forms\Pests;

/*
 * Form to validate storing a pest.
 */

use App\GardenRevolution\Forms\Form;

class StorePestForm extends Form
{
    public function getPreparedRules()
    {
        return [

            'common_name' => 'required',

            'latin_name' => 'required'

        ];
    }
}
