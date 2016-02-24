<?php

namespace App\GardenRevolution\Forms\Journals;

use App\GardenRevolution\Forms\Form;

class GetJournalForm extends Form
{
    /**
     * @return array
     */
    public function getPreparedRules()
    {
        return [
                'id'=>'required|exists:journals'
               ];        
    }
}
