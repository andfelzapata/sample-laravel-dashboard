<?php

namespace App\GardenRevolution\Repositories;

use App\Models\ProcedureUrgency;
use App\GardenRevolution\Repositories\Contracts\ProcedureUrgenciesRepositoryInterface;

class ProcedureUrgenciesRepository implements ProcedureUrgenciesRepositoryInterface {

    /**
     * @var ProcedureUrgency Model
     */
    private $procedureSeverity;

    public function __construct(ProcedureUrgency $procedureSeverity)
    {
        $this->procedureSeverity = $procedureSeverity;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->procedureSeverity = $this->procedureSeverity->newInstance()->fill($data);

        $this->procedureSeverity->save();

        return $this->procedureSeverity;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->procedureSeverity = $this->procedureSeverity->newInstance()->find($id);

        if( is_null($this->procedureSeverity) ) {
            return false;
        }

        $this->procedureSeverity->fill($data);

        return $this->procedureSeverity->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->procedureSeverity = $this->procedureSeverity->newInstance()->find($id, $columns);

        return $this->procedureSeverity;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->procedureSeverity = $this->procedureSeverity->newInstance()->find($id);

        if( is_null($this->procedureSeverity) )
        {
            return false;
        }

        return $this->procedureSeverity->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->procedureSeverity->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->procedureSeverity->newInstance()->paginate($pages);
    }


}