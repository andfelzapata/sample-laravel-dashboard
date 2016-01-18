<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'url',
        'description',
        'active_from',
        'active_to'
    ];
}
