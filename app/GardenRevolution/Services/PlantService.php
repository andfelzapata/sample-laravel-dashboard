<?php

namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\Jobs\JobFactory;
use App\GardenRevolution\Helpers\ReflectionHelper;
use App\GardenRevolution\Forms\Plants\PlantFormFactory;
use App\GardenRevolution\Responders\Admin\PlantsResponder;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\CategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SubcategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\ZoneRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantAverageSizeRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantMoistureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantFertilizationRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantGrowthRateRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantMaintenanceRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantNegativeTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantPositiveTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantSunExposureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantTolerationRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantTypeRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SponsorRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SoilRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\ProcedureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PestRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding plants
 */
class PlantService extends Service
{
    /**
     * @var PlantRepository
     */
    private $plantRepository;

    /**
     * @var PayloadFactory
     */
    protected $payloadFactory;

    /**
     * @var
     */
    private $formFactory;

    public function __construct(
        PayloadFactory $payloadFactory,
        PlantRepositoryInterface $plantRepository,
        PlantFormFactory $formFactory,
        CategoryRepositoryInterface $categoryRepository,
        SubcategoryRepositoryInterface $subcategoryRepository,
        ZoneRepositoryInterface $zoneRepository,
        SearchableNameRepositoryInterface $searchableNameRepository,
        PlantAverageSizeRepositoryInterface $plantAverageSizeRepository,
        PlantGrowthRateRepositoryInterface $plantGrowthRateRepository,
        PlantMaintenanceRepositoryInterface $plantMaintenanceRepository,
        PlantMoistureRepositoryInterface $plantMoistureRepository,
        PlantFertilizationRepositoryInterface $plantFertilizationRepository,
        PlantNegativeTraitRepositoryInterface $plantNegativeTraitRepository,
        PlantPositiveTraitRepositoryInterface $plantPositiveTraitRepository,
        PlantSunExposureRepositoryInterface $plantSunExposureRepository,
        PlantTolerationRepositoryInterface $plantTolerationRepository,
        PlantTypeRepositoryInterface $plantTypeRepository,
        SponsorRepositoryInterface $sponsorRepository,
        SoilRepositoryInterface $soilRepository,
        ProcedureRepositoryInterface $procedureRepository,
        PestRepositoryInterface $pestRepository,
        JobFactory $jobFactory
    )
    {
        $this->plantRepository = $plantRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->zoneRepository = $zoneRepository;
        $this->plantFertilizationRepository = $plantFertilizationRepository;
        $this->plantAverageSizeRepository = $plantAverageSizeRepository;
        $this->plantGrowthRateRepository = $plantGrowthRateRepository;
        $this->plantMaintenanceRepository = $plantMaintenanceRepository;
        $this->plantNegativeTraitRepository = $plantNegativeTraitRepository;
        $this->plantPositiveTraitRepository = $plantPositiveTraitRepository;
        $this->plantSunExposureRepository = $plantSunExposureRepository;
        $this->plantTolerationRepository = $plantTolerationRepository;
        $this->plantTypeRepository = $plantTypeRepository;
        $this->sponsorRepository = $sponsorRepository;
        $this->searchableNames = $searchableNameRepository;
        $this->soilRepository = $soilRepository;
        $this->procedureRepository = $procedureRepository;
        $this->pestRepository = $pestRepository;
        $this->jobFactory = $jobFactory;
    }

    /**
     * @param $pages
     * @param $eagerLoads
     * @return mixed
     */
    public function getPlants($pages, $eagerLoads)
    {
        $plants = $this->plantRepository->getAllPaginated($pages, $eagerLoads);

        if( $plants )
        {
            $data = [
                'plants'=> $plants
            ];

            return $this->success($data);
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getPlant($id)
    {
        $data = [];

        $plant = $this->plantRepository->find($id);

        if( ! $plant) {
            $data['errors'] = 'not found';
            return $this->notAccepted($data);
        }

        $data['plant'] = $plant;

        return $this->found($data);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $data = [
            'plant' => $this->plantRepository->find($id),

            'plant_types' => $this->plantTypeRepository->getAll(),

            'categories' => $this->categoryRepository->getPlantCategories(),

            'subcategories' => $this->subcategoryRepository->getPlantSubcategories(),

            'searchable_names' => $this->searchableNames->getPlantSearchableNames(),

            'zones' => $this->zoneRepository->getAll(),

            'tolerations' => $this->plantTolerationRepository->getAll(),

            'negative_traits' => $this->plantNegativeTraitRepository->getAll(),

            'positive_traits' => $this->plantPositiveTraitRepository->getAll(),

            'growth_rates' => $this->plantGrowthRateRepository->getAll(),

            'average_sizes' => $this->plantAverageSizeRepository->getAll(),

            'fertilizations' => $this->plantFertilizationRepository->getAll(),

            'maintenances' => $this->plantMaintenanceRepository->getAll(),

            'sun_exposure' => $this->plantSunExposureRepository->getAll(),

            'soils' => $this->soilRepository->getAll(),

            'sponsors' => $this->sponsorRepository->getAll(),

        ];

        return $this->found($data);
    }

    /**
     * @param       $id
     * @param array $input
     *
     * @return mixed
     */
    public function update($id, array $input)
    {
        $form = $this->formFactory->newUpdatePlantFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->plantRepository->update($input, $id);

        if( $updated )
        {
            return $this->updated($updated);
        }

        else
        {
            return $this->notUpdated($updated);
        }
    }

    public function create()
    {
        $data = [

            'plant_types' => $this->plantTypeRepository->getAll(),

            'categories' => $this->categoryRepository->getPlantCategories(),

            'subcategories' => $this->subcategoryRepository->getPlantSubcategories(),

            'searchable_names' => $this->searchableNames->getPlantSearchableNames(),

            'zones' => $this->zoneRepository->getAll(),

            'tolerations' => $this->plantTolerationRepository->getAll(),

            'negative_traits' => $this->plantNegativeTraitRepository->getAll(),

            'positive_traits' => $this->plantPositiveTraitRepository->getAll(),

            'growth_rates' => $this->plantGrowthRateRepository->getAll(),

            'average_sizes' => $this->plantAverageSizeRepository->getAll(),

            'maintenances' => $this->plantMaintenanceRepository->getAll(),

            'fertilizations' => $this->plantFertilizationRepository->getAll(),

            'sun_exposure' => $this->plantSunExposureRepository->getAll(),

            'soils' => $this->soilRepository->getAll(),

            'sponsors' => $this->sponsorRepository->getAll()

        ];

        return $this->success($data);
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {

        $form = $this->formFactory->newStorePlantFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $plant = $this->plantRepository->create($input);

        if($plant)
        {
            $name = $plant->common_name;
            $model = ReflectionHelper::getShortName($plant);
            $model = ucwords($model);
            $jobData = array('name'=>$name,'model'=>$model);
            $job = $this->jobFactory->newAddedNotificationInstance($jobData);
            
            dispatch($job);

            return $this->created($plant);
        }

        return $this->notCreated();

    }

    public function delete($id)
    {
        $deleted = $this->plantRepository->delete($id);

        if( $deleted )
        {
            return $this->deleted();
        }

        else
        {
            return $this->notDeleted();
        }
    }

}
