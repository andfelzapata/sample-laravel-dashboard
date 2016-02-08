<?php

namespace App\GardenRevolution\Forms\Terms;

use App\GardenRevolution\Forms\Form;

class GetTermForm extends Form
{
    /**
     * @return array
     */
    public function getPreparedRules()
    {
        return [
                'id'=>'required|exists:terms'
               ];        
    }
}
