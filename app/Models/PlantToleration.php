<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantToleration extends Model
{
    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant', 'plant_toleration_pivot');
    }
}
