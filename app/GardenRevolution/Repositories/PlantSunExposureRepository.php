<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantSunExposure;
use App\GardenRevolution\Repositories\Contracts\PlantSunExposureRepositoryInterface;

class PlantSunExposureRepository implements PlantSunExposureRepositoryInterface {

    /**
     * @var PlantSunExposure Model
     */
    private $plantSunExposure;

    public function __construct(PlantSunExposure $plantSunExposure)
    {
        $this->plantSunExposure = $plantSunExposure;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantSunExposure = $this->plantSunExposure->newInstance()->fill($data);

        return $this->plantSunExposure->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantSunExposure = $this->plantSunExposure->newInstance()->find($id);

        if( is_null($this->plantSunExposure) ) {
            return false;
        }

        $this->plantSunExposure->fill($data);

        return $this->plantSunExposure->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantSunExposure = $this->plantSunExposure->newInstance()->find($id, $columns);

        return $this->plantSunExposure;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantSunExposure = $this->plantSunExposure->newInstance()->find($id);

        if( is_null($this->plantSunExposure) )
        {
            return false;
        }

        return $this->plantSunExposure->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantSunExposure->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixeds
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantSunExposure->newInstance()->paginate($pages);
    }


}