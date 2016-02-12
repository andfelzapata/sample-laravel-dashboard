<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'user_id',

        'status_id',

        'plant_id',

        'pest_id',

        'procedure_id',

        'alert_id',

        'title',

        'content'
    ];


}
