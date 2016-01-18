<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model {
    /**
     * Allowed fills to be mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'botanical_name',
        'common_name',
        'plant_type_id',
        'description',
        'category_id',
        'subcategory_id',
        'zone_id',
        'moisture',
        'description',
        'notes',
        'main_image',
        'sponsor_id',
        'plant_average_size_id',
        'plant_growth_rate_id',
        'plant_maintenance_id',
        'plant_sun_exposure_id',
    ];

    /**
     * Fields that would not be shown.
     * @var array
     */
    protected $hidden = [
        'category_id',
        'subcategory_id',
        'zone-id',
        'plant_growth_rate_id',
        'plant_average_size_id',
        'plant_maintenance_id',
        'plant_sun_exposure_id',
        'sponsor_id',
        'zone_id',
        'plant_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'main_image' => 'json',
    ];

    /**
     * Return the type of the plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Models\PlantType', 'plant_type_id');
    }

    /**
     * Return category that owns plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Return subcategory that owns plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function searchableNames()
    {
        return $this->belongsToMany('App\Models\SearchableName', 'plant_searchable_name_pivot');
    }

    /**
     * Return maintenance classification of plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function maintenance()
    {
        return $this->belongsTo('App\Models\PlantMaintenance', 'plant_maintenance_id');
    }

    /**
     * Return average size of plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function averageSize()
    {
        return $this->belongsTo('App\Models\PlantAverageSize', 'plant_average_size_id');
    }

    /**
     * Return growth rate of plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function growthRate()
    {
        return $this->belongsTo('App\Models\PlantGrowthRate', 'plant_growth_rate_id');
    }

    /**
     * Return sun exposure of plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sunExposure()
    {
        return $this->belongsto('App\Models\PlantSunExposure', 'plant_sun_exposure_id');
    }

    /**
     * return esponsor that owns plant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sponsor()
    {
        return $this->belongsTo('App\Models\Sponsor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function soils()
    {
        return $this->belongsToMany('App\Models\Soil');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tolerations()
    {
        return $this->belongsToMany('App\Models\PlantToleration', 'plant_toleration_pivot');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function positiveTraits()
    {
        return $this->belongsToMany('App\Models\PlantPositiveTrait', 'positive_trait_plant_pivot');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function negativeTraits()
    {
        return $this->belongsToMany('App\Models\PlantNegativeTrait', 'negative_trait_plant_pivot');
    }
}
