<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Subcategories\SubcategoryFormFactory;
use App\GardenRevolution\Repositories\Contracts\SubcategoryRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding users
 */

class SubcategoryService extends Service
{
    /**
     * @var SubcategoryRepository
     */
    private $subcategoryRepository;

    /**
     * @var SubcategoryFormFactory
     */
    private $formFactory;

    public function __construct(
        PayloadFactory $payloadFactory,
        SubcategoryRepositoryInterface $subcategoryRepository,
        SubcategoryFormFactory $formFactory
    )
    {
        $this->payloadFactory = $payloadFactory;
        $this->subcategoryRepository = $subcategoryRepository;
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
        $form = $this->formFactory->newUpdateSubcategoryFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $subcategory = $this->subcategoryRepository->update($input,$id);

        if( $subcategory )
        {
            return $this->updated($subcategory);
        }

        else
        {
            return $this->notUpdated($subcategory);
        }
    }

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input)
    {
        $form = $this->formFactory->newStoreSubcategoryFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $subcategory = $this->subcategoryRepository->create($input);

        if( $subcategory )
        {
            return $this->created($subcategory);
        }

        else
        {
            return $this->notCreated();
        }
    }
}
