<?php

namespace App\GardenRevolution\Repositories;

use App\Models\SearchableName;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;

class SearchableNameRepository implements SearchableNameRepositoryInterface {

    /**
     * @var Category
     */
    private $searchableName;

    public function __construct(SearchableName $searchableName)
    {
        $this->searchableName = $searchableName;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->searchableName = $this->searchableName->newInstance()->fill($data);

        $this->searchableName->save();

        return $this->searchableName;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->searchableName = $this->searchableName->newInstance()->find($id);

        if( is_null($this->searchableName) ) {
            return false;
        }

        $this->searchableName->fill($data);

        return $this->searchableName->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->searchableName = $this->searchableName->newInstance()->find($id, $columns);

        return $this->searchableName;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->searchableName = $this->searchableName->newInstance()->find($id);

        if( is_null($this->searchableName) )
        {
            return false;
        }

        return $this->searchableName->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->searchableName->get();
    }

    /**
     * Return Collection of App\Models\SearchableName
     * of searchable_type App\Models\Plant.
     *
     * @return mixed
     */
    public function getPlantSearchableNames()
    {
        return $this->searchableName->plantSearchableNames();
    }

    /**
     * Return Collection of App\Models\SearchableName
     * of searchable_type App\Models\Pest.
     *
     * @return mixed
     */
    public function getPestSearchableNames()
    {
        return $this->searchableName->pestSearchableNames();
    }

    /**
     * Return Collection of App\Models\SearchableName
     * of searchable_type App\Models\Procedure.
     *
     * @return mixed
     */
    public function getProcedureSearchableNames()
    {
        return $this->searchableName->procedureSearchableNames();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->searchableName->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}