<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Plant;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantTolerationRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantSunExposureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantPositiveTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantNegativeTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantAverageSizeRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantGrowthRateRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantMaintenanceRepositoryInterface;

class PlantRepository implements PlantRepositoryInterface {

    /**
     * @var Plant
     */
    private $plant;

    /**
     * @var
     */
    private $plantTolerationRepository;

    /**
     * @var
     */
    private $plantSunExposureRepository;

    /**
     * @var
     */
    private $plantPositiveTraitRepository;

    /**
     * @var
     */
    private $plantNegativeTraitRepository;

    /**
     * @var
     */
    private $plantAverageSizeRepository;

    /**
     * @var
     */
    private $plantGrowthRateRepository;

    /**
     * @var
     */
    private $plantMaintenanceRepository;

    public function __construct(
        Plant $plant,
        PlantTolerationRepositoryInterface $plantTolerationRepository,
        PlantSunExposureRepositoryInterface $plantSunExposureRepository,
        PlantPositiveTraitRepositoryInterface $plantPositiveTraitRepository,
        PlantNegativeTraitRepositoryInterface $plantNegativeTraitRepository,
        PlantAverageSizeRepositoryInterface $plantAverageSizeRepository,
        PlantGrowthRateRepositoryInterface $plantGrowthRateRepository,
        PlantMaintenanceRepositoryInterface $plantMaintenanceRepository
    )
    {
        $this->plant = $plant;
        $this->plantTolerationRepository = $plantTolerationRepository;
        $this->plantSunExposureRepository = $plantSunExposureRepository;
        $this->plantPositiveTraitRepository = $plantPositiveTraitRepository;
        $this->plantNegativeTraitRepository = $plantNegativeTraitRepository;
        $this->plantAverageSizeRepository = $plantAverageSizeRepository;
        $this->plantGrowthRateRepository = $plantGrowthRateRepository;
        $this->plantMaintenanceRepository = $plantMaintenanceRepository;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data) {
        var_dump($data);

        $this->plant = $this->plant->newInstance()->fill($data);
        $this->plant->save();

        return $this->plant;
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

        $this->plant->fill($data);

        return $this->plant->save();
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
            'categories',

            'subcategories',

            'maintenance',

            'averagesize',

            'growthrate',

            'sunexposure',

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
            'categories',
            'subcategories',
            'maintenance',
            'averagesize',
            'growthrate',
            'sunexposure',
            'sponsor',
            'zone',
            'soils',
            'type',
            'tolerations',
            'searchablenames',
            'negativetraits',
            'positivetraits')->get();
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
                    ->orderBy('created_at', 'desc')
                    ->paginate($pages);
    }


}