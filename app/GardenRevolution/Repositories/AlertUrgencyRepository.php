<?php

namespace App\GardenRevolution\Repositories;

use App\Models\AlertUrgency;
use App\GardenRevolution\Repositories\Contracts\AlertUrgencyRepositoryInterface;

class AlertUrgencyRepository implements AlertUrgencyRepositoryInterface {

    /**
     * @var AlertUrgency Model
     */
    private $alertUrgency;

    public function __construct(AlertUrgency $alertUrgency)
    {
        $this->alertUrgency = $alertUrgency;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->alertUrgency = $this->alertUrgency->newInstance()->fill($data);

        $this->alertUrgency->save();

        return $this->alertUrgency;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->alertUrgency = $this->alertUrgency->newInstance()->find($id);

        if( is_null($this->alertUrgency) ) {
            return false;
        }

        $this->alertUrgency->fill($data);

        return $this->alertUrgency->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->alertUrgency = $this->alertUrgency->newInstance()->find($id, $columns);

        return $this->alertUrgency;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->alertUrgency = $this->alertUrgency->newInstance()->find($id);

        if( is_null($this->alertUrgency) )
        {
            return false;
        }

        return $this->alertUrgency->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->alertUrgency->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->alertUrgency->newInstance()->paginate($pages);
    }


}