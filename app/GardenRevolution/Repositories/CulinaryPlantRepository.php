<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Plant;
use DB;
use App\GardenRevolution\Repositories\Contracts\CulinaryPlantRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantTolerationRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantPositiveTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantNegativeTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SoilRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SponsorRepositoryInterface;
use App\GardenRevolution\Helpers\PlantRepositoryRelatedModels as RelatedModels;

class CulinaryPlantRepository implements CulinaryPlantRepositoryInterface {

    /**
     * @var Plant
     */
    private $plant;

    /**
     * @var RelatedModels
     */
    private $relatedModels;

    public function __construct(
        Plant $plant,
        PlantTolerationRepositoryInterface $plantTolerationRepository,
        PlantPositiveTraitRepositoryInterface $plantPositiveTraitRepository,
        PlantNegativeTraitRepositoryInterface $plantNegativeTraitRepository,
        SearchableNameRepositoryInterface $searchableNameRepository,
        SoilRepositoryInterface $soilRepository,
        SponsorRepositoryInterface $sponsorRepository
    )
    {
        $this->plant = $plant;

        $this->relatedModels = new RelatedModels(
            $plantTolerationRepository,
            $plantPositiveTraitRepository,
            $plantNegativeTraitRepository,
            $searchableNameRepository,
            $soilRepository,
            $sponsorRepository);
    }

    /**
     * @param array $data
     *
     * @return $this|Plant
     */
    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            $data['zone_id'] = 1;

            $this->plant = $this->plant->newInstance()->fill($data);
            $this->plant->save();

            $this->relatedModels->storePlantRelatedModels($data, $this->plant);

            DB::commit();

            return $this->plant;
        }

        catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * Method used for creating plants in seeds
     *
     * @param array $data
     *
     * @return $this|Plant
     */
    public function createForSeed(array $data)
    {
        DB::beginTransaction();

        try {

            $this->plant = $this->plant->newInstance()->fill($data);
            $this->plant->save();

            DB::commit();

            return $this->plant;
        }

        catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * @param array $data
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->plant = $this->plant->newInstance()->find($id);

        if( is_null($this->plant) ) {
            return false;
        }

        DB::beginTransaction();

        try {

            $data['zone_id'] = 1;

            $this->plant->fill($data);

            $this->plant->save();

            $this->relatedModels->storePlantRelatedModels($data, $this->plant);

            DB::commit();

            return $this->plant;
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
        $eagerLoads = [
            'category',

            'subcategory',

            'maintenance',

            'averagesize',

            'growthrate',

            'sunexposure',

            'moisture',

            'sponsor',

            'zone',

            'soils',

            'type',

            'tolerations',

            'searchablenames',

            'negativetraits',

            'positivetraits'];

        $this->plant = $this->plant->newInstance()->with($eagerLoads)->find($id, $columns);

        return $this->plant;

    }

    /**
     * @param $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $this->plant = $this->plant->newInstance()->find($id);

        if( is_null($this->plant) )
        {
            return false;
        }

        return $this->plant->delete();

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->plant->with(
            'category',
            'subcategory',
            'maintenance',
            'averagesize',
            'growthrate',
            'sunexposure',
            'moistures',
            'sponsor',
            'zone',
            'soils',
            'type',
            'tolerations',
            'searchablenames',
            'negativetraits',
            'positivetraits')->where('plant_type_id', 2)->get();
    }

    /**
     * @param int $pages
     * @param Contracts\Array|array $eagerLoads
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($pages = 15, Array $eagerLoads = [])
    {
        return $this->plant->newInstance()
            ->with($eagerLoads)
            ->where('plant_type_id', 2)
            ->orderBy('created_at', 'desc')
            ->paginate($pages);
    }


}
