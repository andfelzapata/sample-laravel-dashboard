<?php namespace App\GardenRevolution\Forms\Journals;

/*
 * Form to validate user delete.
 */

use App\GardenRevolution\Forms\Form;

class DeleteJournalForm extends Form
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric|exists:journals,id'
               ];        
    }
}
