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

    public function searchableNames()
    {
        return $this->belongsToMany('App\Models\SearchableName', 'procedure_searchable_name_pivot')->where('searchable_type', 'App\Models\Procedure');
    }
}
