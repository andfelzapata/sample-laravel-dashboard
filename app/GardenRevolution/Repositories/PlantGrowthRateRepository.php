<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantGrowthRate;

class PlantGrowthRateRepository {

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
        return $this->user->all();
    }

    /**
     * @param int $pages
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 10)
    {
        return $this->plantGrowthRate->newInstance()->paginate($pages);
    }


}