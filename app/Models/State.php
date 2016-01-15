<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
   /*
    * Mass assignable fields.
    * @var array
    */
    protected $fillable = ['name', 'abbreviation'];
}
