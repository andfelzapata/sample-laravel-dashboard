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

    /**
     * Return user that owns journal entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /** Return journal entry status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\JournalStatus');
    }

    /**
     * Return plant that journal entry is related to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plant()
    {
        return $this->belongsTo('App\Models\Plant');
    }

    /**
     * Return pest that journal entry is related to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pest()
    {
        return $this->belongsTo('App\Models\Pest');
    }

    /**
     * Return procedure journal entry is related to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo('App\Models\Procedure');
    }

    /**
     * Return alert journal entry is related to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alert()
    {
        return $this->belongsTo('App\Models\Alert');
    }
}
