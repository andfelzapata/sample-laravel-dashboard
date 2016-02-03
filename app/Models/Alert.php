<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',

        'procedure_id',

        'plant_id',

        'zone_id',

        'alert_urgency_id',

        'start_date',

        'end_date'

    ];

    public function procedure()
    {
        return $this->belongsTo('App\Models\Procedure');
    }

    public function plant()
    {
        return $this->belongsTo('App\Models\Plant');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    public function urgency()
    {
        return $this->belongsTo('App\Models\AlertUrgency', 'alert_urgency_id');
    }
}
