<?php

namespace App\GardenRevolution\Services;

use App\Providers\ProcedureSeverityServiceProvider;
use Aura\Payload\PayloadFactory;
use App\Jobs\JobFactory;
use App\GardenRevolution\Helpers\ReflectionHelper;
use App\GardenRevolution\Forms\Procedures\ProcedureFormFactory;
use App\GardenRevolution\Repositories\Contracts\ProcedureRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\CategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SubcategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\ProcedureUrgenciesRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\ProcedureFrequenciesRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SponsorRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding procedures
 */
class ProcedureService extends Service
{
    /**
     * @var ProcedureRepository
     */
    private $procedureRepository;

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
        ProcedureRepositoryInterface $procedureRepository,
        ProcedureFormFactory $formFactory,
        CategoryRepositoryInterface $categoryRepository,
        SubcategoryRepositoryInterface $subcategoryRepository,
        SearchableNameRepositoryInterface $searchableNameRepository,
        ProcedureUrgenciesRepositoryInterface $procedureUrgenciesRepository,
        ProcedureFrequenciesRepositoryInterface $procedureFrequenciesRepository,
        SponsorRepositoryInterface $sponsorRepository,
        JobFactory $jobFactory
    )
    {
        $this->procedureRepository = $procedureRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->searchableNames = $searchableNameRepository;
        $this->procedureUrgenciesRepository = $procedureUrgenciesRepository;
        $this->procedureFrequenciesRepository = $procedureFrequenciesRepository;
        $this->sponsorRepository = $sponsorRepository;
        $this->jobFactory = $jobFactory;
    }

    /**
     * @param $pages
     * @param $eagerLoads
     * @return mixed
     */
    public function getProcedures($pages, $eagerLoads)
    {

        $procedures = $this->procedureRepository->getAllPaginated($pages, $eagerLoads);

        if( $procedures )
        {
            $data = [
                'procedures'=> $procedures
            ];

            return $this->success($data);
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getProcedure($id)
    {
        $data = [];

        $procedure = $this->procedureRepository->find($id);

        if( ! $procedure) {
            $data['errors'] = 'not found';
            return $this->notAccepted($data);
        }

        $data['procedure'] = $procedure;

        return $this->found($data);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $data = [

            'procedure' => $this->procedureRepository->find($id),

            'categories' => $this->categoryRepository->getProcedureCategories(),

            'subcategories' => $this->subcategoryRepository->getProcedureSubcategories(),

            'searchable_names' => $this->searchableNames->getProcedureSearchableNames(),

            'sponsors' => $this->sponsorRepository->getAll(),

            'urgencies' => $this->procedureUrgenciesRepository->getAll(),

            'frequencies' => $this->procedureFrequenciesRepository->getAll(),

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
        $form = $this->formFactory->newUpdateProcedureFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->procedureRepository->update($input, $id);

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

            'categories' => $this->categoryRepository->getProcedureCategories(),

            'subcategories' => $this->subcategoryRepository->getProcedureSubcategories(),

            'searchable_names' => $this->searchableNames->getProcedureSearchableNames(),

            'sponsors' => $this->sponsorRepository->getAll(),

            'urgencies' => $this->procedureUrgenciesRepository->getAll(),

            'frequencies' => $this->procedureFrequenciesRepository->getAll(),
        ];

        return $this->success($data);
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {

        $form = $this->formFactory->newStoreProcedureFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $procedure = $this->procedureRepository->create($input);

        if($procedure)
        {
            $name = $procedure->name;
            $model = ReflectionHelper::getShortName($procedure);
            $model = ucwords($model);
            $jobData = array('name'=>$name,'model'=>$model);
            $job = $this->jobFactory->newAddedNotificationInstance($jobData);
            
            dispatch($job);

            return $this->created($procedure);
        }

        return $this->notCreated();

    }

    public function delete($id)
    {
        $deleted = $this->procedureRepository->delete($id);

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
