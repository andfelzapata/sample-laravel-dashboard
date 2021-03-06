<?php

namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;
use App\GardenRevolution\Forms\CulinaryPlants\CulinaryPlantFormFactory;
use App\GardenRevolution\Repositories\Contracts\CulinaryPlantRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\ZoneRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\CategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SubcategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantAverageSizeRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantFertilizationRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantMaintenanceRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantGrowthRateRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantNegativeTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantPositiveTraitRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantSunExposureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantTolerationRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantTypeRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SponsorRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SoilRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding culinary plants
 */
class CulinaryPlantService extends Service
{
    /**
     * @var PlantRepository
     */
    private $culinaryPlantRepository;

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
        CulinaryPlantRepositoryInterface $culinaryPlantRepository,
        CulinaryPlantFormFactory $formFactory,
        CategoryRepositoryInterface $categoryRepository,
        ZoneRepositoryInterface $zoneRepository,
        SubcategoryRepositoryInterface $subcategoryRepository,
        SearchableNameRepositoryInterface $searchableNameRepository,
        PlantAverageSizeRepositoryInterface $plantAverageSizeRepository,
        PlantGrowthRateRepositoryInterface $plantGrowthRateRepository,
        PlantFertilizationRepositoryInterface $plantFertilizationRepository,
        PlantMaintenanceRepositoryInterface $plantMaintenanceRepository,
        PlantNegativeTraitRepositoryInterface $plantNegativeTraitRepository,
        PlantPositiveTraitRepositoryInterface $plantPositiveTraitRepository,
        PlantSunExposureRepositoryInterface $plantSunExposureRepository,
        PlantTolerationRepositoryInterface $plantTolerationRepository,
        PlantTypeRepositoryInterface $plantTypeRepository,
        SponsorRepositoryInterface $sponsorRepository,
        SoilRepositoryInterface $soilRepository)
    {
        $this->culinaryPlantRepository = $culinaryPlantRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
        $this->categoryRepository = $categoryRepository;
        $this->zoneRepository = $zoneRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->plantFertilizationRepository = $plantFertilizationRepository;
        $this->plantAverageSizeRepository = $plantAverageSizeRepository;
        $this->plantGrowthRateRepository = $plantGrowthRateRepository;
        $this->plantMaintenanceRepository = $plantMaintenanceRepository;
        $this->plantFertilizationRepository = $plantFertilizationRepository;
        $this->plantNegativeTraitRepository = $plantNegativeTraitRepository;
        $this->plantPositiveTraitRepository = $plantPositiveTraitRepository;
        $this->plantSunExposureRepository = $plantSunExposureRepository;
        $this->plantTolerationRepository = $plantTolerationRepository;
        $this->plantTypeRepository = $plantTypeRepository;
        $this->sponsorRepository = $sponsorRepository;
        $this->searchableNames = $searchableNameRepository;
        $this->soilRepository = $soilRepository;

    }

    /**
     * @param $pages
     * @param $eagerLoads
     * @return mixeds
     */
    public function getPlants($pages, $eagerLoads)
    {
        $plants = $this->culinaryPlantRepository->getAllPaginated($pages, $eagerLoads);

        if( $plants )
        {
            $data = [
                'culinary_plants'=> $plants
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

        $plant = $this->culinaryPlantRepository->find($id);

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
            'plant' => $this->culinaryPlantRepository->find($id),

            'plant_types' => $this->plantTypeRepository->getAll(),

            'categories' => $this->categoryRepository->getPlantCategories(),

            'zones' => $this->zoneRepository->getAll(),

            'subcategories' => $this->subcategoryRepository->getPlantSubcategories(),

            'searchable_names' => $this->searchableNames->getPlantSearchableNames(),

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
        $form = $this->formFactory->newUpdateCulinaryPlantFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->culinaryPlantRepository->update($input, $id);

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

            'tolerations' => $this->plantTolerationRepository->getAll(),

            'negative_traits' => $this->plantNegativeTraitRepository->getAll(),

            'positive_traits' => $this->plantPositiveTraitRepository->getAll(),

            'growth_rates' => $this->plantGrowthRateRepository->getAll(),

            'zones' => $this->zoneRepository->getAll(),

            'average_sizes' => $this->plantAverageSizeRepository->getAll(),

            'maintenances' => $this->plantMaintenanceRepository->getAll(),

            'fertilizations' => $this->plantFertilizationRepository->getAll(),

            'sun_exposure' => $this->plantSunExposureRepository->getAll(),

            'soils' => $this->soilRepository->getAll(),

            'sponsors' => $this->sponsorRepository->getAll(),

        ];

        return $this->success($data);
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {

        $form = $this->formFactory->newStoreCulinaryPlantFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $plant = $this->culinaryPlantRepository->create($input);

        if($plant)
        {
            return $this->created($plant);
        }

        return $this->notCreated();

    }

    public function delete($id)
    {
        $deleted = $this->culinaryPlantRepository->delete($id);

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
