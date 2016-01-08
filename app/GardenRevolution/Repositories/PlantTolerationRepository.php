<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantToleration;

class PlantTolerationRepository {

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

        return $this->plantToleration->save();
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
        return $this->user->all();
    }

    /**
     * @param int $pages
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 10)
    {
        return $this->plantToleration->newInstance()->paginate($pages);
    }


}