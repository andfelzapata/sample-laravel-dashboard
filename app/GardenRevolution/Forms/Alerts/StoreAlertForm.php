<?php

namespace App\GardenRevolution\Forms\Alerts;

/*
 * Form to validate storing a pest.
 */

use App\GardenRevolution\Forms\Form;

class StoreAlertForm extends Form
{
    public function getPreparedRules()
    {
        return [

            'name' => 'required',

        ];
    }
}
