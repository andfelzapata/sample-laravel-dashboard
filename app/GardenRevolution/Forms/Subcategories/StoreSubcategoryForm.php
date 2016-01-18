<?php

namespace App\GardenRevolution\Forms\Subcategories;

/*
 * Form to validate storing a plant.
 */

use App\GardenRevolution\Forms\Form;

class StoreSubcategoryForm extends Form
{
    public function getPreparedRules()
    {
        return [
            'subcategory'=>'required',
            'subcategory_type'=>'required'
        ];
    }
}
