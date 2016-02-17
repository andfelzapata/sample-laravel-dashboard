<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'journal_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status'];
}
