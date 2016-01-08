<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantAverageSize;
use App\GardenRevolution\Repositories\Contracts\PlantAverageSizeRepositoryInterface;

class PlantAverageSizeRepository implements PlantAverageSizeRepositoryInterface {

    /**
     * @var PlantAverageSize Model
     */
    private $plantAverageSize;

    public function __construct(PlantAverageSize $plantAverageSize)
    {
        $this->plantAverageSize = $plantAverageSize;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantAverageSize = $this->plantAverageSize->newInstance()->fill($data);

        return $this->plantAverageSize->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantAverageSize = $this->plantAverageSize->newInstance()->find($id);

        if( is_null($this->plantAverageSize) ) {
            return false;
        }

        $this->plantAverageSize->fill($data);

        return $this->plantAverageSize->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantAverageSize = $this->plantAverageSize->newInstance()->find($id, $columns);

        return $this->plantAverageSize;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantAverageSize = $this->plantAverageSize->newInstance()->find($id);

        if( is_null($this->plantAverageSize) )
        {
            return false;
        }

        return $this->plantAverageSize->delete();

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
        return $this->plantAverageSize->newInstance()->paginate($pages);
    }


}