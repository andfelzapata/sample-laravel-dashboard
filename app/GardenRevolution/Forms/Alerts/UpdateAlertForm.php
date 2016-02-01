<?php namespace App\GardenRevolution\Forms\Alerts;

use App\GardenRevolution\Forms\Form;

class UpdateAlertForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'name' => 'required'
        ];
    }
}
