<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Term;

use App\GardenRevolution\Repositories\Contracts\GlossaryRepositoryInterface;

class GlossaryRepository implements GlossaryRepositoryInterface {

    /**
     * @var term
     */
    private $term;

    public function __construct(Term $term)
    {
        $this->term = $term;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        $this->term = $this->term->newInstance()->fill($data);

        $this->term->save();

        return $this->term;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->term = $this->term->newInstance()->find($id);

        if( is_null($this->term) ) {
            return false;
        }
 
        $this->term->fill($data);

        $this->term->save();

        return $this->term;
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->term = $this->term->newInstance()->find($id, $columns);

        return $this->term;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->term = $this->term->newInstance()->find($id);

        if( is_null($this->term) )
        {
            return false;
        }

        return $this->term->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->term->get();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->term->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }
}
