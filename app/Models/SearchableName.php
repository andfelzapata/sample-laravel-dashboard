<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchableName extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'searchable_type',

        'name'
    ];

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
     * @return mixed
     */
    public function plants()
    {
        return $this->where('searchable_type', 'App\Models\Plant');
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
     * @return mixed
     */
    public function pests()
    {
        return $this->where('searchable_type', 'App\Models\Pest');
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

    /**
     * @return mixed
     */
    public function procedures()
    {
        return $this->where('searchable_type', 'App\Models\Procedure');
    }
}
