<?php

namespace App\GardenRevolution\Helpers;

class SubcategoryTypeTransformer {
    /**
     * Container for existing subcategory types.
     *
     * @var array
     */
    protected $subcategoryTypes = [
        'plant' => 'App\Models\Plant',

        'procedure' => 'App\Models\Procedure',

        'pest' => 'App\Models\Pest',
    ];

    /**
     * @param array $data
     *
     * @return array
     */
    public function plantSubcategory(Array $data)
    {
        $data['subcategory_type'] = $this->subcategoryTypes['plant'];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function pestSubcategory(Array $data)
    {
        $data['subcategory_type'] = $this->subcategoryTypes['pest'];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function procedureSubcategory(Array $data)
    {
        $data['subcategory_type'] = $this->subcategoryTypes['procedure'];

        return $data;
    }
}