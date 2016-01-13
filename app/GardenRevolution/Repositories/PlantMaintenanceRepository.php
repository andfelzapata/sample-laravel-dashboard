<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantMaintenance;
use App\GardenRevolution\Repositories\Contracts\PlantMaintenanceRepositoryInterface;

class PlantMaintenanceRepository implements PlantMaintenanceRepositoryInterface {

    /**
     * @var PlantMaintenance Model
     */
    private $plantMaintenance;

    public function __construct(PlantMaintenance $plantMaintenance)
    {
        $this->plantMaintenance = $plantMaintenance;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantMaintenance = $this->plantMaintenance->newInstance()->fill($data);

        return $this->plantMaintenance->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantMaintenance = $this->plantMaintenance->newInstance()->find($id);

        if( is_null($this->plantMaintenance) ) {
            return false;
        }

        $this->plantMaintenance->fill($data);

        return $this->plantMaintenance->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantMaintenance = $this->plantMaintenance->newInstance()->find($id, $columns);

        return $this->plantMaintenance;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantMaintenance = $this->plantMaintenance->newInstance()->find($id);

        if( is_null($this->plantMaintenance) )
        {
            return false;
        }

        return $this->plantMaintenance->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantMaintenance->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantMaintenance->newInstance()->paginate($pages);
    }


}