<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Journal;
use App\GardenRevolution\Repositories\Contracts\JournalRepositoryInterface;

class JournalRepository implements JournalRepositoryInterface {

    /**
     * @var Journal Model
     */
    private $journal;

    public function __construct(Journal $journal)
    {
        $this->journal = $journal;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->journal = $this->journal->newInstance()->fill($data);

        $this->journal->save();

        return $this->journal;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->journal = $this->journal->newInstance()->find($id);

        if( is_null($this->journal) ) {
            return false;
        }

        $this->journal->fill($data);

        return $this->journal->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->journal = $this->journal->newInstance()->find($id, $columns);

        return $this->journal;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->journal = $this->journal->newInstance()->find($id);

        if( is_null($this->journal) )
        {
            return false;
        }

        return $this->journal->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->journal->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->journal->newInstance()->with($eagerLoads)->paginate($pages);
    }


}