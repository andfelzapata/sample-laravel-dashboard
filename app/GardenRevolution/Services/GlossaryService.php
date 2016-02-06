<?php namespace App\GardenRevolution\Services;

use DB;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Helpers\CategoryTypeTransformer;

use App\GardenRevolution\Repositories\Contracts\GlossaryRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding glossary
 */

class GlossaryService extends Service
{
    private $glossaryRepository;
    private $categoryTypeTransformer;

    public function __construct(GlossaryRepositoryInterface $glossaryRepository, PayloadFactory $payloadFactory, CategoryTypeTransformer $categoryTypeTransformer) 
    {
        $this->glossaryRepository = $glossaryRepository;
        $this->payloadFactory = $payloadFactory;
        $this->categoryTypeTransformer = $categoryTypeTransformer;
    }

    public function index()
    {
        $terms = $this->glossaryRepository->getAllPaginated();
        $terms->setPath('/admin/dashboard/#glossary');//Set pagination path on pagination object

        $categoryTypes = array_flip($this->categoryTypeTransformer->getCategoryTypes());

        $termsLinks = $terms->links();

        $terms = $terms->transform(
                                        function($item, $key) use ($categoryTypes) 
                                        {  
                                            $item->category_type = ucwords($categoryTypes[$item->category_type]);
                                            return $item;  
                                        }); 

        $data['terms'] = $terms;
        $data['terms_links'] = $termsLinks;

        return $this->success($data);
    }

    public function find($id) 
    {
        $form = $this->formFactory->newUpdateTermFormInstance();
 
        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }
        
        $term = $this->glossaryRepository->find($id);
        $data['term'] = $term;

        if( $term->id )
        {
            return $this->found($data);
        }

        else
        {
            return $this->notFound($data);
        }
    }

    public function update($id, array $input)
    {
        $form = $this->formFactory->newGetTermFormInstance();
        $input['id'] = $id;

        $data = [];

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $term = $this->glossaryRepository->update($input,$id);
        $data['term'] = $term;

        if( $term->id )
        {
            return $this->updated($data);
        }

        else
        {
            return $this->notUpdated($data);
        }
    }

    public function create()
    {
        return $this->success();
    }

    public function store(array $input)
    {
        $form = $this->formFactory->newStoreTermFormInstance();
        
        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }
        
        $term = $this->userRepository->store($input);

        if( $term->id )
        {
            return $this->created();
        }

        else
        {
            return $this->notCreated();
        }
    }

    public function delete($id)
    {
        $form = $this->formFactory->newDeleteTermFormInstance();
        $input['id'] = $id;

        $data = [];

        if( !$form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $deleted = $this->glossaryRepository->delete($id);

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
