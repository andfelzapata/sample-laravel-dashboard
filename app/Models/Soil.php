<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soil extends Model
{
    /**
     * Mass assignable fields.
     *
     * @var array
     */
    protected $fillable = [

        'soil_type'

    ];

    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant');
    }
}
