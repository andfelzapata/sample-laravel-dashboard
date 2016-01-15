<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantToleration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'toleration'
    ];

    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant', 'plant_toleration_pivot');
    }
}
