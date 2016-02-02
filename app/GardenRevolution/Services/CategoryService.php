<?php namespace App\GardenRevolution\Services;

use DB;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Categories\CategoryFormFactory;
use App\GardenRevolution\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService extends Service {
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var CategoryFormFactory
     */
    private $formFactory;

    private $types = array('plant'=>'Plant','procedure'=>'Procedure','pest'=>'Pest');

    public function __construct(
        PayloadFactory $payloadFactory,
        CategoryRepositoryInterface $categoryRepository,
        CategoryFormFactory $formFactory
    )
    {
        $this->payloadFactory = $payloadFactory;
        $this->categoryRepository = $categoryRepository;
        $this->formFactory = $formFactory;
    }

    public function create() 
    {
        $output['types'] = $this->types;

        return $this->success($output);
    }

    /**
     * @param $id
     * @param array $input
     *
     * @return mixed
     */
    public function update($id, array $input)
    {
        $form = $this->formFactory->newUpdateCategoryFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $category = $this->categoryRepository->update($input,$id);

        if( $category->id )
        {
            return $this->updated();
        }

        else
        {
            return $this->notUpdated();
        }
    }

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input)
    {
        $form = $this->formFactory->newStoreCategoryFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $category = $this->categoryRepository->create($input);

        if( $category->id )
        {
            return $this->created();
        }

        else
        {
            return $this->notCreated();
        }
    }
}
