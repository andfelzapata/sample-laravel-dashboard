<?php namespace App\GardenRevolution\Forms\Subcategories;

use App\GardenRevolution\Forms\Form;

class UpdateSubcategoryForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'common_name'=>'required',
            'botanical_name'=>'required'
        ];
    }
}
