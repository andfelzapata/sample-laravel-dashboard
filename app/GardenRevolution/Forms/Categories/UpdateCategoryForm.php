<?php

namespace App\GardenRevolution\Forms\Categories;

use App\GardenRevolution\Forms\Form;

class UpdateCategoryForm extends Form
{
    public function getPreparedRules() 
    {
        return  [
            'category'=>'required|unique:categories,category,{$this->data["id"]},id',
            'category_type'=>'required',
            'id'=>'required'
        ];
    }
}
