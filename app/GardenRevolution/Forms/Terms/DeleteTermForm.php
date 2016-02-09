<?php namespace App\GardenRevolution\Forms\Terms;

/*
 * Form to validate user delete.
 */

use App\GardenRevolution\Forms\Form;

class DeleteTermForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric|exists:terms,id'
               ];        
    }
}
