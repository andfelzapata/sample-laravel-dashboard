<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /*
     * The attributes that are mass assignable
     * @array
     */
    protected $fillable = ['date','amount','status','payment_id'];

    public $timestamps = false;
}
