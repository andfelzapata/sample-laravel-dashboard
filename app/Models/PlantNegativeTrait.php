<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantNegativeTrait extends Model
{
    protected $table = 'negative_traits';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant', 'negative_trait_plant_pivot');
    }
}
