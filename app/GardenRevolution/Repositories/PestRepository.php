<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Pest;
use DB;
use App\GardenRevolution\Repositories\Contracts\PestRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;
use App\GardenRevolution\Helpers\PestRepositoryRelatedModels as RelatedModels;

class PestRepository implements PestRepositoryInterface {

    /**
     * @var Pest Model
     */
    private $pest;

    /**
     * @var
     */
    private $relatedModels;

    public function __construct(Pest $pest, SearchableNameRepositoryInterface $searchableNameRepository)
    {
        $this->pest = $pest;

        $this->relatedModels = new RelatedModels($searchableNameRepository);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            $this->pest = $this->pest->newInstance()->fill($data);
            $this->pest->save();

            $this->relatedModels->storePestRelatedModels($data, $this->pest);

            DB::commit();

            return $this->pest;
        }

        catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }


    /**
     * @param array $data
     *
     * @return $this|Pest
     */
    public function createForSeed(array $data)
    {
        $this->pest = $this->pest->newInstance()->fill($data);

        $this->pest->save();

        return $this->pest;
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->pest = $this->pest->newInstance()->find($id);

        if( is_null($this->pest) ) {
            return false;
        }

        DB::beginTransaction();

        try {

            $this->pest->fill($data);

            $this->pest->save();

            $this->relatedModels->storePestRelatedModels($data, $this->pest);

            DB::commit();

            return $this->pest;
        }

        catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * @param       $id
     * @param array $columns
     *a
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->pest = $this->pest->newInstance()->find($id, $columns);

        return $this->pest;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->pest = $this->pest->newInstance()->find($id);

        if( is_null($this->pest) )
        {
            return false;
        }

        return $this->pest->delete();

    }

    /**
     * @param array $eagerLoads
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($eagerLoads = [])
    {
        return $this->pest->with($eagerLoads)->get();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->pest->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}