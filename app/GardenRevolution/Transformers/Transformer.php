<?php

namespace App\GardenRevolution\Transformers;

abstract class Transformer {

    /**
     * Transform a collection.
     *
     * @param array $collection
     *
     * @return array
     */
    public function transformCollection(array $collection)
    {

        return array_map([$this, 'transform'], $collection);
    }

    public abstract function transform($item);
}