<?php

namespace App\GardenRevolution\Services;

use App\Providers\PestSeverityServiceProvider;
use Aura\Payload\PayloadFactory;
use App\Jobs\JobFactory;
use App\GardenRevolution\Helpers\ReflectionHelper;
use App\GardenRevolution\Forms\Pests\PestFormFactory;
use App\GardenRevolution\Repositories\Contracts\PestRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\CategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SubcategoryRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PestSeveritiesRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SearchableNameRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SponsorRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding pests
 */
class PestService extends Service
{
    /**
     * @var PestRepository
     */
    private $pestRepository;

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
        PestRepositoryInterface $pestRepository,
        PestFormFactory $formFactory,
        CategoryRepositoryInterface $categoryRepository,
        SubcategoryRepositoryInterface $subcategoryRepository,
        SearchableNameRepositoryInterface $searchableNameRepository,
        PestSeveritiesRepositoryInterface $pestSeveritiesRepository,
        SponsorRepositoryInterface $sponsorRepository,
        JobFactory $jobFactory
    )
    {
        $this->pestRepository = $pestRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->searchableNames = $searchableNameRepository;
        $this->pestSeveritiesRepository = $pestSeveritiesRepository;
        $this->sponsorRepository = $sponsorRepository;
        $this->jobFactory = $jobFactory;
    }

    /**
     * @param $pages
     * @param $eagerLoads
     * @return mixed
     */
    public function getPests($pages, $eagerLoads)
    {

        $pests = $this->pestRepository->getAllPaginated($pages, $eagerLoads);

        if( $pests )
        {
            $data = [
                'pests'=> $pests
            ];

            return $this->success($data);
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getPest($id)
    {
        $data = [];

        $pest = $this->pestRepository->find($id);

        if( ! $pest) {
            $data['errors'] = 'not found';
            return $this->notAccepted($data);
        }

        $data['pest'] = $pest;

        return $this->found($data);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $data = [

            'pest' => $this->pestRepository->find($id),

            'categories' => $this->categoryRepository->getPestCategories(),

            'subcategories' => $this->subcategoryRepository->getPestSubcategories(),

            'searchable_names' => $this->searchableNames->getPestSearchableNames(),

            'sponsors' => $this->sponsorRepository->getAll(),

            'severities' => $this->pestSeveritiesRepository->getAll(),

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
        $form = $this->formFactory->newUpdatePestFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->pestRepository->update($input, $id);

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

            'categories' => $this->categoryRepository->getPestCategories(),

            'subcategories' => $this->subcategoryRepository->getPestSubcategories(),

            'searchable_names' => $this->searchableNames->getPestSearchableNames(),

            'sponsors' => $this->sponsorRepository->getAll(),

            'severities' => $this->pestSeveritiesRepository->getAll(),
        ];

        return $this->success($data);
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {

        $form = $this->formFactory->newStorePestFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $pest = $this->pestRepository->create($input);

        if($pest)
        {
            $name = $pest->common_name;
            $model = ReflectionHelper::getShortName($pest);
            $model = ucwords($model);
            $jobData = array('name'=>$name,'model'=>$model);
            $job = $this->jobFactory->newAddedNotificationInstance($jobData);
            
            dispatch($job);

            return $this->created($pest);
        }

        return $this->notCreated();

    }

    public function delete($id)
    {
        $deleted = $this->pestRepository->delete($id);

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
