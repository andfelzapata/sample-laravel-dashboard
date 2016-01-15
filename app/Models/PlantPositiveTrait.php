<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantPositiveTrait extends Model
{
    protected $table = 'positive_traits';

    /**
     * Masss assignable fields.
     *
     * @var array
     */
    protected $fillable = [
        'characteristic'
    ];

    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant', 'positive_trait_plant_pivot');
    }
}
