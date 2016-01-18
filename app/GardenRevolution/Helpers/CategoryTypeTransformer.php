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
    public function plantCategory(Array $data)
    {
        $data['category_type'] = $this->categoryTypes['plant'];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function pestCategory(Array $data)
    {
        $data['category_type'] = $this->categoryTypes['pest'];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function procedureCategory(Array $data)
    {
        $data['category_type'] = $this->categoryTypes['procedure'];

        return $data;
    }
}