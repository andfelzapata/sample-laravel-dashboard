<?php

namespace App\GardenRevolution\Repositories;

use App\Models\ProcedureUrgency;
use App\GardenRevolution\Repositories\Contracts\ProcedureUrgenciesRepositoryInterface;

class ProcedureUrgenciesRepository implements ProcedureUrgenciesRepositoryInterface {

    /**
     * @var ProcedureUrgency Model
     */
    private $procedureUrgency;

    public function __construct(ProcedureUrgency $procedureUrgency)
    {
        $this->procedureUrgency = $procedureUrgency;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->procedureUrgency = $this->procedureUrgency->newInstance()->fill($data);

        $this->procedureUrgency->save();

        return $this->procedureUrgency;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->procedureUrgency = $this->procedureUrgency->newInstance()->find($id);

        if( is_null($this->procedureUrgency) ) {
            return false;
        }

        $this->procedureUrgency->fill($data);

        return $this->procedureUrgency->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->procedureUrgency = $this->procedureUrgency->newInstance()->find($id, $columns);

        return $this->procedureUrgency;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->procedureUrgency = $this->procedureUrgency->newInstance()->find($id);

        if( is_null($this->procedureUrgency) )
        {
            return false;
        }

        return $this->procedureUrgency->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->procedureUrgency->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->procedureUrgency->newInstance()->paginate($pages);
    }


}