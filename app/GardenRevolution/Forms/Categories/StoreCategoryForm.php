<?php

namespace App\GardenRevolution\Forms\Categories;

/*
 * Form to validate storing a plant.
 */

use App\GardenRevolution\Forms\Form;

class StoreCategoryForm extends Form
{
    public function getPreparedRules()
    {
        return [
            'category'=>'required|unique:categories,category,NULL,id,category_type,App\Models\Plant',
            'category_type'=>'required'
        ];
    }
}
