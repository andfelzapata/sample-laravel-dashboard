<?php

namespace App\GardenRevolution\Helpers;

class CategoryTypeTransformer {
    /**
     * Container for existing category types.
     *
     * @var array
     */
    protected $categoryTypes = [
        'plant' => 'App\Models\Plant',
        'procedure' => 'App\Models\Procedure',
        'pest' => 'App\Models\Pest',
    ];

    /**
     * @param array $data
     *
     * @return array
     */
    public function transformCategory(array $data)
    {
        $category = $data['category_type'];

        if( isset($this->categoryTypes[$category]) )
        {
            $data['category_type'] = $this->categoryTypes[$category];
        } 

        return $data;
    }

    public function getCategoryTypes()
    {
        return $this->categoryTypes;
    }
}
