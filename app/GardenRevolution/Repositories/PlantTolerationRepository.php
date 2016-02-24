<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantToleration;
use App\GardenRevolution\Repositories\Contracts\PlantTolerationRepositoryInterface;

class PlantTolerationRepository implements PlantTolerationRepositoryInterface {

    /**
     * @var PlantToleration Model
     */
    private $plantToleration;

    public function __construct(PlantToleration $plantToleration)
    {
        $this->plantToleration = $plantToleration;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantToleration = $this->plantToleration->newInstance()->fill($data);

        $this->plantToleration->save();

        return $this->plantToleration;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantToleration = $this->plantToleration->newInstance()->find($id);

        if( is_null($this->plantToleration) ) {
            return false;
        }

        $this->plantToleration->fill($data);

        return $this->plantToleration->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantToleration = $this->plantToleration->newInstance()->find($id, $columns);

        return $this->plantToleration;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantToleration = $this->plantToleration->newInstance()->find($id);

        if( is_null($this->plantToleration) )
        {
            return false;
        }

        return $this->plantToleration->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantToleration->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantToleration->newInstance()->paginate($pages);
    }


}