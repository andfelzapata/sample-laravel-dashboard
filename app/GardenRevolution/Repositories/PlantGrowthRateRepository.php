<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantGrowthRate;
use App\GardenRevolution\Repositories\Contracts\PlantGrowthRateRepositoryInterface;

class PlantGrowthRateRepository implements PlantGrowthRateRepositoryInterface {

    /**
     * @var PlantGrowthRate Model
     */
    private $plantGrowthRate;

    public function __construct(PlantGrowthRate $plantGrowthRate)
    {
        $this->plantGrowthRate = $plantGrowthRate;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantGrowthRate = $this->plantGrowthRate->newInstance()->fill($data);

        return $this->plantGrowthRate->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantGrowthRate = $this->plantGrowthRate->newInstance()->find($id);

        if( is_null($this->plantGrowthRate) ) {
            return false;
        }

        $this->plantGrowthRate->fill($data);

        return $this->plantGrowthRate->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantGrowthRate = $this->plantGrowthRate->newInstance()->find($id, $columns);

        return $this->plantGrowthRate;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantGrowthRate = $this->plantGrowthRate->newInstance()->find($id);

        if( is_null($this->plantGrowthRate) )
        {
            return false;
        }

        return $this->plantGrowthRate->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantGrowthRate->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantGrowthRate->newInstance()->paginate($pages);
    }


}