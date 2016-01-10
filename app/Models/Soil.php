<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soil extends Model
{
    public function plants()
    {
        return $this->belongsToMany('App\Models\Plant');
    }
}
