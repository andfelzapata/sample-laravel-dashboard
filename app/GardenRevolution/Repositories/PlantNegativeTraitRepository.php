<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantNegativeTrait;
use App\GardenRevolution\Repositories\Contracts\PlantNegativeTraitRepositoryInterface;

class PlantNegativeTraitRepository implements PlantNegativeTraitRepositoryInterface {

    /**
     * @var PlantNegativeTrait Model
     */
    private $plantNegativeTrait;

    public function __construct(PlantNegativeTrait $plantNegativeTrait)
    {
        $this->plantNegativeTrait = $plantNegativeTrait;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantNegativeTrait = $this->plantNegativeTrait->newInstance()->fill($data);

        return $this->plantNegativeTrait->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantNegativeTrait = $this->plantNegativeTrait->newInstance()->find($id);

        if( is_null($this->plantNegativeTrait) ) {
            return false;
        }

        $this->plantNegativeTrait->fill($data);

        return $this->plantNegativeTrait->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantNegativeTrait = $this->plantNegativeTrait->newInstance()->find($id, $columns);

        return $this->plantNegativeTrait;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantNegativeTrait = $this->plantNegativeTrait->newInstance()->find($id);

        if( is_null($this->plantNegativeTrait) )
        {
            return false;
        }

        return $this->plantNegativeTrait->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantNegativeTrait->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantNegativeTrait->newInstance()->paginate($pages);
    }


}