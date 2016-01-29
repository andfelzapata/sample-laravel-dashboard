<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'common_name',

        'latin_name',

        'category_id',

        'subcategory_id',

        'severity_id',

        'pest_description',

        'damage_description',

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
     * Return category that owns pest model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Return subcategory that owns pest model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id');
    }

    /**
     * Return severity that owns the pest model.
     * @return mixed
     */
    public function severity()
    {
        return $this->belongsTo('App\Models\PestSeverity', 'severity_id');
    }


    /**
     * Return sponsor that owns the pest model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sponsor()
    {
        return $this->belongsTo('App\Models\Sponsor', 'sponsor_id');
    }

    /**
     * Return searchable names that belong to given pest model.
     *
     * @return mixed
     */
    public function searchableNames()
    {
        return $this->belongsToMany('App\Models\SearchableName', 'pest_searchable_name_pivot')->where('searchable_type', 'App\Models\Pest');
    }
}
