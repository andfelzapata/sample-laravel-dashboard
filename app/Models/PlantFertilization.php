<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantFertilization extends Model
{
    protected $table = 'plant_fertilization';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fertilization'];

    public function plants()
    {
        return $this->hasMany('App\Models\Plant');
    }
}
