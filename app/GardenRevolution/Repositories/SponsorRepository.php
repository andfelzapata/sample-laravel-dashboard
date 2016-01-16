<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Sponsor;
use App\GardenRevolution\Repositories\Contracts\SponsorRepositoryInterface;

class SponsorRepository implements SponsorRepositoryInterface {

    /**
     * @var Sponsor Model
     */
    private $sponsor;

    public function __construct(Sponsor $sponsor)
    {
        $this->sponsor = $sponsor;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {

        $this->sponsor = $this->sponsor->newInstance()->fill($data);

        $this->sponsor->save();

        return $this->sponsor;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->sponsor = $this->sponsor->newInstance()->find($id);

        if( is_null($this->sponsor) ) {
            return false;
        }

        $this->sponsor->fill($data);

        return $this->sponsor->save();
    }

    /**
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->sponsor = $this->sponsor->newInstance()->find($id, $columns);

        return $this->sponsor;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->sponsor = $this->sponsor->newInstance()->find($id);

        if( is_null($this->sponsor) )
        {
            return false;
        }

        return $this->sponsor->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->sponsor->all();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->sponsor->newInstance()->paginate($pages);
    }


}