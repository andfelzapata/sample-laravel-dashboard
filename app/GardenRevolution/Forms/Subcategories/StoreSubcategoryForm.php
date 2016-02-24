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
            'subcategory' => 'required|unique:subcategories,subcategory,NULL,id,subcategory_type,App\Models\Plant',
            'subcategory_type' => 'required'
        ];
    }
}
