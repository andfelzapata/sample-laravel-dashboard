<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Soil;
use App\GardenRevolution\Repositories\Contracts\SoilRepositoryInterface;


class SoilRepository implements SoilRepositoryInterface {

    /**
     * @var Soil Model
     */
    private $soil;

    public function __construct(Soil $soil)
    {
        $this->soil = $soil;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->soil = $this->soil->newInstance()->fill($data);

        return $this->soil->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->soil = $this->soil->newInstance()->find($id);

        if( is_null($this->soil) ) {
            return false;
        }

        $this->soil->fill($data);

        return $this->soil->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->soil = $this->soil->newInstance()->find($id, $columns);

        return $this->soil;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->soil = $this->soil->newInstance()->find($id);

        if( is_null($this->soil) )
        {
            return false;
        }

        return $this->soil->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->soil->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->soil->newInstance()->paginate($pages);
    }


}