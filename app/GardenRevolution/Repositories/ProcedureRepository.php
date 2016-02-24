<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Procedure;
use DB;
use App\GardenRevolution\Repositories\Contracts\ProcedureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;
use App\GardenRevolution\Helpers\ProcedureRepositoryRelatedModels as RelatedModels;

class ProcedureRepository implements ProcedureRepositoryInterface {

    /**
     * @var Procedure Model
     */
    private $procedure;

    /**
     * @var
     */
    private $relatedModels;

    public function __construct(Procedure $procedure, SearchableNameRepositoryInterface $searchableNameRepository)
    {
        $this->procedure = $procedure;

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

            $this->procedure = $this->procedure->newInstance()->fill($data);
            $this->procedure->save();

            $this->relatedModels->storeProcedureRelatedModels($data, $this->procedure);

            DB::commit();

            return $this->procedure;
        }

        catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * @param array $data
     *
     * @return $this|Procedure
     */
    public function createForSeed(array $data)
    {
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

        DB::beginTransaction();

        try {

            $this->procedure->fill($data);

            $this->procedure->save();

            $this->relatedModels->storeProcedureRelatedModels($data, $this->procedure);

            DB::commit();

            return $this->procedure;
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
     * @param array $eagerLoads
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($eagerLoads = [])
    {
        return $this->procedure->with($eagerLoads)->get();
    }

    /**
     * @param int $pages
     * @param array $eagerLoads
     *
     * @return mixed
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->procedure->newInstance()
            ->with($eagerLoads)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }

    /**
     * @param $query
     * @param array $eagerLoads
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search($query, $eagerLoads = [])
    {
        return $this->procedure->newInstance()
            ->with($eagerLoads)
            ->where('name', 'like', '%'.$query.'%')
            ->get();
    }

}