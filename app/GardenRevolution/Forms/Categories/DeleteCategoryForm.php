<?php namespace App\GardenRevolution\Forms\Categories;

/*
 * Form to validate user delete.
 */

use App\GardenRevolution\Forms\Form;

class DeleteCategoryForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric|exists:categories,id'
               ];        
    }
}
