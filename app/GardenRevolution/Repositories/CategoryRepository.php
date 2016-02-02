<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Category;
use App\GardenRevolution\Repositories\Contracts\CategoryRepositoryInterface;
use App\GardenRevolution\Helpers\CategoryTypeTransformer;

class CategoryRepository implements CategoryRepositoryInterface {

    /**
     * @var Category
     */
    private $category;

    /**
     * @var
     */
    private $categoryTypeTransformer;

    public function __construct(Category $category, CategoryTypeTransformer $categoryTypeTransformer)
    {
        $this->category = $category;

        $this->categoryTypeTransformer = $categoryTypeTransformer;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        $data = $this->categoryTypeTransformer->transformCategory($data);

        $this->category = $this->category->newInstance()->fill($data);

        $this->category->save();

        return $this->category;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->category = $this->category->newInstance()->find($id);

        if( is_null($this->category) ) {
            return false;
        }

        $this->category->fill($data);

        $this->category->save();

        return $this->category;
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->category = $this->category->newInstance()->find($id, $columns);

        return $this->category;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->category = $this->category->newInstance()->find($id);

        if( is_null($this->category) )
        {
            return false;
        }

        return $this->category->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->category->get();
    }

    /**
     * Return Collection of App\Models\Category
     * of categorizable_type App\Models\Plant.
     *
     * @return mixed
     */
    public function getPlantCategories()
    {
        return $this->category->plantCategories();
    }

    /**
     * Return Collection of App\Models\Category
     * of categorizable_type App\Models\Pest.
     *
     * @return mixed
     */
    public function getPestCategories()
    {
        return $this->category->pestCategories();
    }

    /**
     * Return Collection of App\Models\Category
     * of categorizable_type App\Models\Procedure.
     *
     * @return mixed
     */
    public function getProcedureCategories()
    {
        return $this->category->procedureCategories();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->category->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}
