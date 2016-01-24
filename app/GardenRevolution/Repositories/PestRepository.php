<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Pest;
use App\GardenRevolution\Repositories\Contracts\PestRepositoryInterface;

class PestRepository implements PestRepositoryInterface {

    /**
     * @var Pest Model
     */
    private $pest;

    public function __construct(Pest $pest)
    {
        $this->pest = $pest;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->pest = $this->pest->newInstance()->fill($data);

        $this->pest->save();

        return $this->pest;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->pest = $this->pest->newInstance()->find($id);

        if( is_null($this->pest) ) {
            return false;
        }

        $this->pest->fill($data);

        return $this->pest->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->pest = $this->pest->newInstance()->find($id, $columns);

        return $this->pest;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->pest = $this->pest->newInstance()->find($id);

        if( is_null($this->pest) )
        {
            return false;
        }

        return $this->pest->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->pest->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->pest->newInstance()->paginate($pages);
    }


}