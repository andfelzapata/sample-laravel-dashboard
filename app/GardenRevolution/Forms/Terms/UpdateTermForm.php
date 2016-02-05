<?php

namespace App\GardenRevolution\Forms\Categories;

use App\GardenRevolution\Forms\Form;

class UpdateCategoryForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'category'=>'required|unique:categories,category,'.$this->data['id'].'id',//Not sure why I have to make sure id is the primary key
            'category_type'=>'required',
            'id'=>'required'
        ];
    }
}
