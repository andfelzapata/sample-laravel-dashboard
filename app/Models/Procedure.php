<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',

        'category_id',

        'subcategory_id',

        'urgency_id',

        'how',

        'why',

        'main_image',

        'main_video',

        'sponsor_id'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

        'main_image' => 'json',

        'main_video' => 'json',

    ];

    /**
     * Return category that owns procedure model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Return subcategory that owns procedure model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id');
    }

    /**
     * Returns severity that owns the procedure model.
     *
     * @return mixed
     */
    public function urgency()
    {
        return $this->belongsTo('App\Models\ProcedureUrgency', 'urgency_id');
    }

    /**
     * Returns frequency that owns the procedure model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frequency()
    {
        return $this->belongsTo('App\Models\ProcedureFrequency', 'frequency_id');
    }

    /**
     * Return sponsor that owns the procedure model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sponsor()
    {
        return $this->belongsTo('App\Models\Sponsor', 'sponsor_id');
    }

    public function searchableNames()
    {
        return $this->belongsToMany('App\Models\SearchableName', 'procedure_searchable_name_pivot')->where('searchable_type', 'App\Models\Procedure');
    }
}
