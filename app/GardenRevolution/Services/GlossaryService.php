<?php namespace App\GardenRevolution\Services;

use DB;

use Log;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Terms\TermFormFactory;

use App\GardenRevolution\Helpers\CategoryTypeTransformer;

use App\GardenRevolution\Repositories\Contracts\GlossaryRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding glossary
 */

class GlossaryService extends Service
{
    private $glossaryRepository;
    private $categoryTypeTransformer;

    public function __construct(
                                    GlossaryRepositoryInterface $glossaryRepository, 
                                    PayloadFactory $payloadFactory,
                                    TermFormFactory $formFactory,
                                    CategoryTypeTransformer $categoryTypeTransformer) 
    {
        $this->glossaryRepository = $glossaryRepository;
        $this->payloadFactory = $payloadFactory;
        $this->categoryTypeTransformer = $categoryTypeTransformer;
        $this->formFactory = $formFactory;
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
        $categoryTypes = array_keys($this->categoryTypeTransformer->getCategoryTypes());
        $types = array();

        foreach($categoryTypes as $categoryType)
        {
            $types[$categoryType] = ucwords($categoryType);
        }

        $output['types'] = $types;

        return $this->success($output);
    }

    public function store(array $input)
    {
        try {

            DB::beginTransaction();
            
            $form = $this->formFactory->newStoreTermFormInstance();
            $categoryTypes = $this->categoryTypeTransformer->getCategoryTypes();

            if( isset($categoryTypes[$input['category_type']]) )
            {
                $input['category_type'] = $categoryTypes[$input['category_type']];
            }

            if( ! $form->isValid($input) )
            {
                $data['errors'] = $form->getErrors();
                return $this->notAccepted($data);
            }

            $uploadedImage = array_pull($input,'image');
            $altTag = array_pull($input,'alt_tag');
            $extension = $uploadedImage->getClientOriginalExtension();

            $folder = sprintf('%s/%s','images','glossary');
            $filename = sprintf('%s.%s',str_random(32),$extension);

            $path = sprintf('%s/%s',$folder,$filename);

            $imageData = array('path'=>$path,'alt'=>$altTag);
            $imageData = json_encode($imageData);

            $input['image'] = $imageData;

            $term = $this->glossaryRepository->create($input);

            if( $term->id )
            {
                $uploadedImage->move($folder,$filename);

                DB::commit();
                return $this->created();
            }

            else
            {
                DB::rollback();
                return $this->notCreated();
            }

        }

        catch(Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return $this->error();
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
