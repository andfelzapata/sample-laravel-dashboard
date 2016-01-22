<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantMoisture;
use App\GardenRevolution\Repositories\Contracts\PlantMoistureRepositoryInterface;

class PlantMoistureRepository implements PlantMoistureRepositoryInterface {

    /**
     * @var PlantMoisture
     */
    private $plantMoisture;

    public function __construct(PlantMoisture $plantMoisture)
    {
        $this->plantMoisture = $plantMoisture;
    }

    /**
     * @param array $data
     *
     * @return $this|PlantMoisture
     */
    public function create(array $data)
    {

        $this->plantMoisture = $this->plantMoisture->newInstance()->fill($data);

        $this->plantMoisture->save();

        return $this->plantMoisture;
    }


    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantMoisture = $this->plantMoisture->newInstance()->find($id);

        if( is_null($this->plantMoisture) ) {
            return false;
        }

        $this->plantMoisture->fill($data);

        $this->plantMoisture->save();

        return $this->plantMoisture;

    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {

        $this->plantMoisture = $this->plantMoisture->newInstance()->find($id, $columns);

        return $this->plantMoisture;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantMoisture = $this->plantMoisture->newInstance()->find($id);

        if( is_null($this->plantMoisture) )
        {
            return false;
        }

        return $this->plantMoisture->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantMoisture->get();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantMoisture->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}
