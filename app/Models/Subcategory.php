<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * Return morphed category model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subcategorizable()
    {
        return $this->morphTo();
    }

    /**
     * Return subcategories for plants.
     *
     * @return mixed
     */
    public function plantSubcategories()
    {
        return $this->where('subcategorizable_type', 'App\Models\Plant')->get();
    }

    /**
     * Return subcategories for pests.
     *
     * @return mixed
     */
    public function pestSubcategories()
    {
        return $this->where('subcategorizable_type', 'App\Models\Plant')->get();
    }

    /**
     * Return subcategories for procedures.
     *
     * @return mixed
     */
    public function procedureSubcategories()
    {
        return $this->where('subcategorizable_type', 'App\Models\Plant')->get();
    }
}
