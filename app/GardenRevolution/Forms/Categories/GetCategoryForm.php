<?php

namespace App\GardenRevolution\Forms\Categories;

use App\GardenRevolution\Forms\Form;

class GetCategoryForm extends Form
{
    /**
     * @return array
     */
    public function getPreparedRules()
    {
        return [
                'id'=>'required|exists:categories'
               ];        
    }
}
