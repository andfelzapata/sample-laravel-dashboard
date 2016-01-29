<?php

namespace App\GardenRevolution\Forms\Procedures;

/*
 * Form to validate storing a pest.
 */

use App\GardenRevolution\Forms\Form;

class StoreProcedureForm extends Form
{
    public function getPreparedRules()
    {
        return [

            'name' => 'required',

        ];
    }
}
