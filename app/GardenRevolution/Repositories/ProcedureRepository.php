<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Procedure;
use App\GardenRevolution\Repositories\Contracts\ProcedureRepositoryInterface;

class ProcedureRepository implements ProcedureRepositoryInterface {

    /**
     * @var Procedure Model
     */
    private $procedure;

    public function __construct(Procedure $procedure)
    {
        $this->procedure = $procedure;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->procedure = $this->procedure->newInstance()->fill($data);

        $this->procedure->save();

        return $this->procedure;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->procedure = $this->procedure->newInstance()->find($id);

        if( is_null($this->procedure) ) {
            return false;
        }

        $this->procedure->fill($data);

        return $this->procedure->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->procedure = $this->procedure->newInstance()->find($id, $columns);

        return $this->procedure;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->procedure = $this->procedure->newInstance()->find($id);

        if( is_null($this->procedure) )
        {
            return false;
        }

        return $this->procedure->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->procedure->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->procedure->newInstance()->paginate($pages);
    }


}