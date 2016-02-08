<?php

namespace App\GardenRevolution\Forms\Terms;

use App\GardenRevolution\Forms\Form;

class UpdateTermForm extends Form
{
    public function getPreparedRules() 
    {
        return [
            'id'=>'required|exists:terms',
            'category_type'=>'required|exists:categories,category_type',
            'name'=>'required|unique:terms,name,'.$this->data['id'].',id|max:32',
            'description'=>'sometimes|max:140',
            'meaning'=>'sometimes|max:140',
            'pronunciation'=>'sometimes|max:32',
            'alt_tag'=>'sometimes|max:16'
        ];
    }
}
