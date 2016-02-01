<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Alert;
use App\GardenRevolution\Repositories\Contracts\AlertRepositoryInterface;

class AlertRepository implements AlertRepositoryInterface {

    /**
     * @var Alert Model
     */
    private $alert;

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->alert = $this->alert->newInstance()->fill($data);

        $this->alert->save();

        return $this->alert;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->alert = $this->alert->newInstance()->find($id);

        if( is_null($this->alert) ) {
            return false;
        }

        $this->alert->fill($data);

        return $this->alert->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->alert = $this->alert->newInstance()->find($id, $columns);

        return $this->alert;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->alert = $this->alert->newInstance()->find($id);

        if( is_null($this->alert) )
        {
            return false;
        }

        return $this->alert->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->alert->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->alert->newInstance()->paginate($pages);
    }


}