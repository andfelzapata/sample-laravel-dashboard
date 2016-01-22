<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantMoisture extends Model
{
    protected $table = 'plant_moisture';

    /**
     * Returns plants that belong to a give plant moisture.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany('App\Models\Plant');
    }
}
