<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category', 'category_type'];

    /**
     * Return categories for plants.
     *
     * @return mixed
     */
    public function plantCategories()
    {
        return $this->where('category_type', 'App\Models\Plant')->get();
    }

    /**
     * Return categories for pests.
     *
     * @return mixed
     */
    public function pestCategories()
    {
        return $this->where('category_type', 'App\Models\Pest')->get();
    }

    /**
     * Return categories for procedures.
     *
     * @return mixed
     */
    public function procedureCategories()
    {
        return $this->where('category_type', 'App\Models\Procedure')->get();
    }

    public function plantCategoriesForPage($limit = 10) 
    {
        return $this->where('category_type', 'App\Models\Plant')->paginate($limit);
    }

    public function procedureCategoriesForPage($limit = 10) 
    {
        return $this->where('category_type', 'App\Models\Procedure')->paginate($limit);
    }
  
    public function pestCategoriesForPage($page = 0, $limit = 10) 
    {
        return $this->where('category_type', 'App\Models\Pest')->paginate($limit);
    }
}
