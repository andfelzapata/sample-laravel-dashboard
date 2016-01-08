<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Plant;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;

class PlantRepository implements PlantRepositoryInterface {

    /**
     * @var Soil Model
     */
    private $plant;

    public function __construct(Plant $plant)
    {
        $this->plant = $plant;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plant = $this->plant->newInstance()->fill($data);

        return $this->plant->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plant = $this->plant->newInstance()->find($id);

        if( is_null($this->plant) ) {
            return false;
        }

        $this->plant->fill($data);

        return $this->plant->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plant = $this->plant->newInstance()->find($id, $columns);

        return $this->plant;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plant = $this->plant->newInstance()->find($id);

        if( is_null($this->plant) )
        {
            return false;
        }

        return $this->plant->delete();

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
        return $this->plant->newInstance()->paginate($pages);
    }


}