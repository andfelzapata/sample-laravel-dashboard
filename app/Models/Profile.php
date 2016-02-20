<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /*
     * The attributes that are mass assignable
     * @array
     */
    protected $fillable = ['first_name','last_name','street_address','city','state','zip','apt_suite','user_id','image'];
}
