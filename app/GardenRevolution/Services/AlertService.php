<?php

namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;
use App\GardenRevolution\Forms\Alerts\AlertFormFactory;
use App\GardenRevolution\Repositories\Contracts\AlertRepositoryInterface;   
use App\GardenRevolution\Repositories\Contracts\ProcedureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\AlertUrgenciesRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding alerts
 */
class AlertService extends Service
{
    /**
     * @var AlertRepository
     */
    private $alertRepository;

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
        AlertRepositoryInterface $alertRepository,
        AlertFormFactory $formFactory,
        CategoryRepositoryInterface $categoryRepository,
        SubcategoryRepositoryInterface $subcategoryRepository,
        SearchableNameRepositoryInterface $searchableNameRepository,
        AlertUrgenciesRepositoryInterface $alertUrgenciesRepository,
        SponsorRepositoryInterface $sponsorRepository
    )
    {
        $this->alertRepository = $alertRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->searchableNames = $searchableNameRepository;
        $this->alertUrgenciesRepository = $alertUrgenciesRepository;
        $this->sponsorRepository = $sponsorRepository;

    }

    /**
     * @param $pages
     * @param $eagerLoads
     * @return mixed
     */
    public function getAlerts($pages, $eagerLoads)
    {

        $alerts = $this->alertRepository->getAllPaginated($pages, $eagerLoads);

        if( $alerts )
        {
            $data = [
                'alerts'=> $alerts
            ];

            return $this->success($data);
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getAlert($id)
    {
        $data = [];

        $alert = $this->alertRepository->find($id);

        if( ! $alert) {
            $data['errors'] = 'not found';
            return $this->notAccepted($data);
        }

        $data['alert'] = $alert;

        return $this->found($data);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $data = [

            'alert' => $this->alertRepository->find($id),

            'categories' => $this->categoryRepository->getAlertCategories(),

            'subcategories' => $this->subcategoryRepository->getAlertSubcategories(),

            'searchable_names' => $this->searchableNames->getAlertSearchableNames(),

            'sponsors' => $this->sponsorRepository->getAll(),

            'urgencies' => $this->alertUrgenciesRepository->getAll(),

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
        $form = $this->formFactory->newUpdateAlertFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->alertRepository->update($input, $id);

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

            'categories' => $this->categoryRepository->getAlertCategories(),

            'subcategories' => $this->subcategoryRepository->getAlertSubcategories(),

            'searchable_names' => $this->searchableNames->getAlertSearchableNames(),

            'sponsors' => $this->sponsorRepository->getAll(),

            'urgencies' => $this->alertUrgenciesRepository->getAll(),
        ];

        return $this->success($data);
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {

        $form = $this->formFactory->newStoreAlertFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $alert = $this->alertRepository->create($input);

        if($alert)
        {
            return $this->created($alert);
        }

        return $this->notCreated();

    }

    public function delete($id)
    {
        $deleted = $this->alertRepository->delete($id);

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
