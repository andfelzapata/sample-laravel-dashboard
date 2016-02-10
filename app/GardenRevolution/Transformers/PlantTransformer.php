<?php

namespace App\GardenRevolution\Transformers;

class PlantTransformer extends Transformer {

    /**
     * Transform single plant.
     *
     * @param $plant
     *
     * @return mixed
     */
    public function transform($plant)
    {
        $plant['name'] = $plant['common_name'];

        unset($plant['common_name']);

        return $plant;
    }
}