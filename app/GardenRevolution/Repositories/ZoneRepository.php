<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Zone;
use App\GardenRevolution\Repositories\Contracts\ZoneRepositoryInterface;

class ZoneRepository implements ZoneRepositoryInterface {

    /**
     * @var Zone Model
     */
    private $zone;

    public function __construct(Zone $zone)
    {
        $this->zone = $zone;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->zone = $this->zone->newInstance()->fill($data);

        return $this->zone->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->zone = $this->zone->newInstance()->find($id);

        if( is_null($this->zone) ) {
            return false;
        }

        $this->zone->fill($data);

        return $this->zone->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->zone = $this->zone->newInstance()->find($id, $columns);

        return $this->zone;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->zone = $this->zone->newInstance()->find($id);

        if( is_null($this->zone) )
        {
            return false;
        }

        return $this->zone->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->zone->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->zone->newInstance()->paginate($pages);
    }


}