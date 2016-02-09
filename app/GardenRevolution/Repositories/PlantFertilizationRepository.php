<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantFertilization;
use App\GardenRevolution\Repositories\Contracts\PlantFertilizationRepositoryInterface;

class PlantFertilizationRepository implements PlantFertilizationRepositoryInterface {

    /**
     * @var PlantFertilization
     */
    private $plantFertilization;

    public function __construct(PlantFertilization $plantFertilization)
    {
        $this->plantFertilization = $plantFertilization;
    }

    /**
     * @param array $data
     *
     * @return $this|PlantFertilization
     */
    public function create(array $data)
    {

        $this->plantFertilization = $this->plantFertilization->newInstance()->fill($data);

        $this->plantFertilization->save();

        return $this->plantFertilization;
    }


    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantFertilization = $this->plantFertilization->newInstance()->find($id);

        if( is_null($this->plantFertilization) ) {
            return false;
        }

        $this->plantFertilization->fill($data);

        $this->plantFertilization->save();

        return $this->plantFertilization;

    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {

        $this->plantFertilization = $this->plantFertilization->newInstance()->find($id, $columns);

        return $this->plantFertilization;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantFertilization = $this->plantFertilization->newInstance()->find($id);

        if( is_null($this->plantFertilization) )
        {
            return false;
        }

        return $this->plantFertilization->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantFertilization->get();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantFertilization->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}
