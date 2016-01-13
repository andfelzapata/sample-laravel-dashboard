<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * Return morphed subcategory model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function categorizable()
    {
        return $this->morphTo();
    }

    /**
     * Return categories for plants.
     *
     * @return mixed
     */
    public function plantCategories()
    {
        return $this->where('categorizable_type', 'App\Models\Plant')->get();
    }

    /**
     * Return categories for pests.
     *
     * @return mixed
     */
    public function pestCategories()
    {
        return $this->where('categorizable_type', 'App\Models\Pest')->get();
    }

    /**
     * Return categories for procedures.
     *
     * @return mixed
     */
    public function procedureCategories()
    {
        return 'procedure categories';

        return $this->where('categorizable_type', 'App\Models\Procedure')->get();
    }
}
