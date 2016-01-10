<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantMaintenance extends Model
{
    protected $table = 'plant_maintenance';

    /**
     * Return all the plants that belong to a maintenace.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany('App\Models\Plants');
    }
}
