<?php

namespace App\GardenRevolution\Forms\Sponsors;

/*
 * Form to validate storing a plant.
 */

use App\GardenRevolution\Forms\Form;

class StoreSponsorForm extends Form
{
    public function getPreparedRules()
    {
        return [
            'name'=>'required',
            'email'=>'required'
        ];
    }
}
