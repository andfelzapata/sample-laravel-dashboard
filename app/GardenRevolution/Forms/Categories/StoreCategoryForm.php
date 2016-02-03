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
            'category'=>'required|unique:categories,category',
            'category_type'=>'required'
        ];
    }
}
