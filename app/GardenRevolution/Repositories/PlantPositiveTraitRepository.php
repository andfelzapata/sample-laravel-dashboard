<?php

namespace App\GardenRevolution\Repositories;

use App\Models\PlantPositiveTrait;
use App\GardenRevolution\Repositories\Contracts\PlantPositiveTraitRepositoryInterface;

class PlantPositiveTraitRepository implements PlantPositiveTraitRepositoryInterface {

    /**
     * @var PlantPositiveTrait Model
     */
    private $plantPositiveTrait;

    public function __construct(PlantPositiveTrait $plantPositiveTrait)
    {
        $this->plantPositiveTrait = $plantPositiveTrait;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->plantPositiveTrait = $this->plantPositiveTrait->newInstance()->fill($data);

        return $this->plantPositiveTrait->save();
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plantPositiveTrait = $this->plantPositiveTrait->newInstance()->find($id);

        if( is_null($this->plantPositiveTrait) ) {
            return false;
        }

        $this->plantPositiveTrait->fill($data);

        return $this->plantPositiveTrait->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->plantPositiveTrait = $this->plantPositiveTrait->newInstance()->find($id, $columns);

        return $this->plantPositiveTrait;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plantPositiveTrait = $this->plantPositiveTrait->newInstance()->find($id);

        if( is_null($this->plantPositiveTrait) )
        {
            return false;
        }

        return $this->plantPositiveTrait->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plantPositiveTrait->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plantPositiveTrait->newInstance()->paginate($pages);
    }


}