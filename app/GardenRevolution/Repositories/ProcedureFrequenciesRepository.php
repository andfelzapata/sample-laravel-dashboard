<?php

namespace App\GardenRevolution\Repositories;

use App\Models\ProcedureFrequency;
use App\GardenRevolution\Repositories\Contracts\ProcedureFrequenciesRepositoryInterface;

class ProcedureFrequenciesRepository implements ProcedureFrequenciesRepositoryInterface {

    /**
     * @var ProcedureFrequency Model
     */
    private $procedureFrequency;

    public function __construct(ProcedureFrequency $procedureFrequency)
    {
        $this->procedureFrequency = $procedureFrequency;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->procedureFrequency = $this->procedureFrequency->newInstance()->fill($data);

        $this->procedureFrequency->save();

        return $this->procedureFrequency;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->procedureFrequency = $this->procedureFrequency->newInstance()->find($id);

        if( is_null($this->procedureFrequency) ) {
            return false;
        }

        $this->procedureFrequency->fill($data);

        return $this->procedureFrequency->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->procedureFrequency = $this->procedureFrequency->newInstance()->find($id, $columns);

        return $this->procedureFrequency;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->procedureFrequency = $this->procedureFrequency->newInstance()->find($id);

        if( is_null($this->procedureFrequency) )
        {
            return false;
        }

        return $this->procedureFrequency->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->procedureFrequency->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->procedureFrequency->newInstance()->paginate($pages);
    }


}