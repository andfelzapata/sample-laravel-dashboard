<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Subcategory;
use App\GardenRevolution\Repositories\Contracts\SubCategoryRepositoryInterface;

class subCategoryRepository implements SubCategoryRepositoryInterface {

    /**
     * @var Category
     */
    private $subCategory;

    public function __construct(Subcategory $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->subCategory = $this->subCategory->newInstance()->fill($data);

        return $this->subCategory->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->subCategory = $this->subCategory->newInstance()->find($id);

        if( is_null($this->subCategory) ) {
            return false;
        }

        $this->subCategory->fill($data);

        return $this->subCategory->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->subCategory = $this->subCategory->newInstance()->find($id, $columns);

        return $this->subCategory;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->subCategory = $this->subCategory->newInstance()->find($id);

        if( is_null($this->subCategory) )
        {
            return false;
        }

        return $this->subCategory->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->subCategory->get();
    }

    /**
     * Return Collection of App\Models\Subcategory
     * of categorizable_type App\Models\Plant.
     *
     * @return mixed
     */
    public function getPlantSubcategories()
    {
        return $this->subCategory->plantSubcategories();
    }

    /**
     * Return Collection of App\Models\Subcategory
     * of categorizable_type App\Models\Pest.
     *
     * @return mixed
     */
    public function getPestSubcategories()
    {
        return $this->subCategory->pestSubcategories();
    }

    /**
     * Return Collection of App\Models\Subcategory
     * of categorizable_type App\Models\Procedure.
     *
     * @return mixed
     */
    public function getProcedureSubcategories()
    {
        return $this->subCategory->procedureSubcategories();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->subCategory->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}