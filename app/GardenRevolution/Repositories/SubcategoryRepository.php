<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Subcategory;
use App\GardenRevolution\Helpers\SubcategoryTypeTransformer;
use App\GardenRevolution\Repositories\Contracts\SubCategoryRepositoryInterface;

class SubcategoryRepository implements SubCategoryRepositoryInterface {

    /**
     * @var Subcategory
     */
    private $subcategory;

    /**
     * @var SubcategoryTypeTransformer
     */
    private $subcategoryTypeTransformer;

    public function __construct(Subcategory $subcategory, SubcategoryTypeTransformer $subcategoryTypeTransformer)
    {
        $this->subcategory = $subcategory;

        $this->subcategoryTypeTransformer = $subcategoryTypeTransformer;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        $data = $this->subcategoryTypeTransformer->plantSubcategory($data);

        $this->subcategory = $this->subcategory->newInstance()->fill($data);

        $this->subcategory->save();

        return $this->subcategory;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->subcategory = $this->subcategory->newInstance()->find($id);

        if( is_null($this->subcategory) ) {
            return false;
        }

        $this->subcategory->fill($data);

        return $this->subcategory->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->subcategory = $this->subcategory->newInstance()->find($id, $columns);

        return $this->subcategory;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->subcategory = $this->subcategory->newInstance()->find($id);

        if( is_null($this->subcategory) )
        {
            return false;
        }

        return $this->subcategory->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->subcategory->get();
    }

    /**
     * @return mixed
     */
    public function getPlantSubcategories()
    {
        return $this->subcategory->plantSubcategories();
    }

    /**
     * @return mixed
     */
    public function getPestSubcategories()
    {
        return $this->subcategory->pestSubcategories();
    }

    /**
     * @return mixed
     */
    public function getProcedureSubcategories()
    {
        return $this->subcategory->procedureSubcategories();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->subcategory->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}