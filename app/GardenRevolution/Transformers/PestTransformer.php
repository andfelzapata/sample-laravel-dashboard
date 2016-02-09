<?php

namespace App\GardenRevolution\Transformers;

class PestTransformer extends Transformer {

    /**
     * Transform single pest.
     *
     * @param $pest
     *
     * @return mixed
     */
    public function transform($pest)
    {
        $pest['name'] = $pest['common_name'];

        return $pest;
    }
}