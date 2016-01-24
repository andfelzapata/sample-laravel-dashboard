<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PestSeverity;
use App\GardenRevolution\Repositories\Contracts\PestSeveritiesRepositoryInterface;

class PestSeveritiesRepository implements PestSeveritiesRepositoryInterface {

    /**
     * @var PestSeverity Model
     */
    private $pestSeverity;

    public function __construct(PestSeverity $pestSeverity)
    {
        $this->pestSeverity = $pestSeverity;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->pestSeverity = $this->pestSeverity->newInstance()->fill($data);

        $this->pestSeverity->save();

        return $this->pestSeverity;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->pestSeverity = $this->pestSeverity->newInstance()->find($id);

        if( is_null($this->pestSeverity) ) {
            return false;
        }

        $this->pestSeverity->fill($data);

        return $this->pestSeverity->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->pestSeverity = $this->pestSeverity->newInstance()->find($id, $columns);

        return $this->pestSeverity;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->pestSeverity = $this->pestSeverity->newInstance()->find($id);

        if( is_null($this->pestSeverity) )
        {
            return false;
        }

        return $this->pestSeverity->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->pestSeverity->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->pestSeverity->newInstance()->paginate($pages);
    }


}