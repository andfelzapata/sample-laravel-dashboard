<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchableName extends Model
{
    public function searchable()
    {
        return $this->morphTo();
    }

    /**
     * Return searchable names for plants.
     *
     * @return mixed
     */
    public function plantSearchableNames()
    {
        return $this->where('searchable_type', 'App\Models\Plant')->get();
    }

    /**
     * Return searchable names for pests.
     *
     * @return mixed
     */
    public function pestSearchableNames()
    {
        return $this->where('searchable_type', 'App\Models\Pest')->get();
    }

    /**
     * Return searchable names for procedures.
     *
     * @return mixed
     */
    public function procedureSearchableNames()
    {
        return $this->where('searchable_type', 'App\Models\Procedure')->get();
    }
}
