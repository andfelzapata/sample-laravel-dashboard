<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subcategory', 'subcategory_type'];

    /**
     * Return subcategories for plants.
     *
     * @return mixed
     */
    public function plantSubcategories()
    {
        return $this->where('subcategory_type', 'App\Models\Plant')->get();
    }

    /**
     * Return subcategories for pests.
     *
     * @return mixed
     */
    public function pestSubcategories()
    {
        return $this->where('subcategory_type', 'App\Models\Pest')->get();
    }

    /**
     * Return subcategories for procedures.
     *
     * @return mixed
     */
    public function procedureSubcategories()
    {
        return $this->where('subcategory_type', 'App\Models\Procedure')->get();
    }
}
