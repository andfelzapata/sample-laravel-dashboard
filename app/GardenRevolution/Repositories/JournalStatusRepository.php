<?php

namespace App\GardenRevolution\Repositories;

use App\Models\JournalStatus;
use App\GardenRevolution\Repositories\Contracts\JournalStatusRepositoryInterface;

class JournalStatusRepository implements JournalStatusRepositoryInterface {

    /**
     * @var JournalStatus Model
     */
    private $journalStatus;

    public function __construct(JournalStatus $journalStatus)
    {
        $this->journalStatus = $journalStatus;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->journalStatus = $this->journalStatus->newInstance()->fill($data);

        $this->journalStatus->save();

        return $this->journalStatus;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->journalStatus = $this->journalStatus->newInstance()->find($id);

        if( is_null($this->journalStatus) ) {
            return false;
        }

        $this->journalStatus->fill($data);

        return $this->journalStatus->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->journalStatus = $this->journalStatus->newInstance()->find($id, $columns);

        return $this->journalStatus;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->journalStatus = $this->journalStatus->newInstance()->find($id);

        if( is_null($this->journalStatus) )
        {
            return false;
        }

        return $this->journalStatus->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->journalStatus->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->journalStatus->newInstance()->paginate($pages);
    }


}