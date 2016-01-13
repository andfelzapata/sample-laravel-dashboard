<?php

namespace App\GardenRevolution\Repositories;

use App\Models\SearchableName;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;

class SearchableNameRepository implements SearchableNameRepositoryInterface {

    /**
     * @var Category
     */
    private $searchablName;

    public function __construct(SearchableName $searchablName)
    {
        $this->searchablName = $searchablName;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->searchablName = $this->searchablName->newInstance()->fill($data);

        return $this->searchablName->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->searchablName = $this->searchablName->newInstance()->find($id);

        if( is_null($this->searchablName) ) {
            return false;
        }

        $this->searchablName->fill($data);

        return $this->searchablName->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->searchablName = $this->searchablName->newInstance()->find($id, $columns);

        return $this->searchablName;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->searchablName = $this->searchablName->newInstance()->find($id);

        if( is_null($this->searchablName) )
        {
            return false;
        }

        return $this->searchablName->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->searchablName->get();
    }

    /**
     * Return Collection of App\Models\SearchableName
     * of searchable_type App\Models\Plant.
     *
     * @return mixed
     */
    public function getPlantSearchableNames()
    {
        return $this->searchablName->plantSearchableNames();
    }

    /**
     * Return Collection of App\Models\SearchableName
     * of searchable_type App\Models\Pest.
     *
     * @return mixed
     */
    public function getPestSearchableNames()
    {
        return $this->searchablName->pestSearchableNames();
    }

    /**
     * Return Collection of App\Models\SearchableName
     * of searchable_type App\Models\Procedure.
     *
     * @return mixed
     */
    public function getProcedureSearchableNames()
    {
        return $this->searchablName->procedureSearchableNames();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->searchablName->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}