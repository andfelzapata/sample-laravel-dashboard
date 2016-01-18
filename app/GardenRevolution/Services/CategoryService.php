<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Categories\CategoryFormFactory;
use App\GardenRevolution\Repositories\Contracts\CategoryRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding users
 */

class CategoryService extends Service
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var CategoryFormFactory
     */
    private $formFactory;

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

    /**
     * @param       $id
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

        if( $category )
        {
            return $this->updated($category);
        }

        else
        {
            return $this->notUpdated($category);
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

        if( $category )
        {
            return $this->created($category);
        }

        else
        {
            return $this->notCreated();
        }
    }
}
