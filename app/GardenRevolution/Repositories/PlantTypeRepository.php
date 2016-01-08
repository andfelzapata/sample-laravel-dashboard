<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantType;
use App\GardenRevolution\Repositories\Contracts\PlantTypeRepositoryInterface;

class PlantTypeRepository implements PlantTypeRepositoryInterface {

    /**
     * @var PlantType Model
     */
    private $plantType;

    public function __construct(PlantType $plantType)
    {
        $this->plantType = $plantType;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantType = $this->plantType->newInstance()->fill($data);

        return $this->plantType->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantType = $this->plantType->newInstance()->find($id);

        if( is_null($this->plantType) ) {
            return false;
        }

        $this->plantType->fill($data);

        return $this->plantType->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantType = $this->plantType->newInstance()->find($id, $columns);

        return $this->plantType;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantType = $this->plantType->newInstance()->find($id);

        if( is_null($this->plantType) )
        {
            return false;
        }

        return $this->plantType->delete();

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
        return $this->plantType->newInstance()->paginate($pages);
    }


}