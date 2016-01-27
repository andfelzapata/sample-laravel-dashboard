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
     * Return searchable names that belong to given pest model.
     *
     * @return mixed
     */
    public function searchableNames()
    {
        return $this->belongsToMany('App\Models\SearchableName', 'pest_searchable_name_pivot')->where('searchable_type', 'App\Models\Pest');
    }
}
