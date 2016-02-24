<?php namespace App\GardenRevolution\Services;

use DB;

use App;

use Log;

use File;

use Storage;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Helpers\FileStorage;

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

    public function edit($id) 
    {
        $form = $this->formFactory->newGetTermFormInstance();

        $input['id'] = $id;

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }
        
        $categoryTypes = array_keys($this->categoryTypeTransformer->getCategoryTypes());
        $types = array();

        foreach($categoryTypes as $categoryType)
        {
            $types[$categoryType] = ucwords($categoryType);
        }

        $output['types'] = $types;
   
        $term = $this->glossaryRepository->find($id);

        $imageData = json_decode($term->image);
        $term->image = $imageData;

        $output['term'] = $term;

        if( $term->id )
        {
            return $this->found($output);
        }

        else
        {
            return $this->notFound($output);
        }
    }

    public function update($id, array $input)
    {
        try {
            $form = $this->formFactory->newUpdateTermFormInstance();
            $input['id'] = $id;
        
            $categoryTypes = $this->categoryTypeTransformer->getCategoryTypes();
        
            $categoryType = $input['category_type'];

            $input['category_type'] = $categoryTypes[$categoryType];

            $output = [];

            $pathToDelete = '';
            $pathToMove = '';

            if( ! $form->isValid($input) )
            {
                $data['errors'] = $form->getErrors();
                return $this->notAccepted($data);
            }

            $image = isset($input['image']) ? $input['image'] : null;
            
            //If an image has been uploaded, create paths to old file to be
            //deleted and new file to be stored
            if( isset($image) )
            {
                $term = $this->glossaryRepository->find($id);

                if( isset($term->image) )
                {
                    $imageData = json_decode($term->image);
                
                    $subPath = $imageData->path;
                    
                    $pathToDelete = $subPath;
                    $pathToMove = sprintf('images/glossary/%s.%s',str_random(32),$image->getClientOriginalExtension());

                    $image->path = $pathToMove;
                    $image->alt = $input['alt_tag'];
                    $input['image'] = json_encode($image);
                }

            }

            $term = $this->glossaryRepository->update($input,$id);
            $output['term'] = $term;
        
            if( $term->id )
            {
                DB::commit();
                
                //Check if client uploaded an image, if so delete the old file
                //and upload the new one.
                if( isset($image) ) {
                    FileStorage::delete($pathToDelete);
                    FileStorage::move($image->getRealPath(),$pathToMove);
                }
               
                return $this->updated($output);
            }

            else
            {
                DB::rollback();
                return $this->notUpdated($output);
            }
        }

        catch(Exception $ex)
        {
            DB::rollback();
            return $this->error();
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
            
            //Pull image and alt tag
            $uploadedImage = array_pull($input,'image');
            $altTag = array_pull($input,'alt_tag');
            $extension = $uploadedImage->getClientOriginalExtension();

            //Create subpath
            $folder = sprintf('%s/%s','images','glossary');
            $filename = sprintf('%s.%s',str_random(32),$extension);

            //Create subpath to file 
            $pathToMove = sprintf('%s/%s',$folder,$filename);
            $path = $pathToMove;

            $imageData = array('path'=>$path,'alt'=>$altTag);
            $imageData = json_encode($imageData);

            $input['image'] = $imageData;

            $term = $this->glossaryRepository->create($input);

            if( $term->id )
            {
                DB::commit();

                //Only move file if commit is successful
                FileStorage::move($uploadedImage->getRealPath(),$pathToMove);

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
        try {
            
            $form = $this->formFactory->newDeleteTermFormInstance();
            $input['id'] = $id;

            $data = [];

            if( !$form->isValid($input) )
            {
                $data['errors'] = $form->getErrors();
                return $this->notAccepted($data);
            }

            $term = $this->glossaryRepository->find($id);

            $imageData = json_decode($term->image);

            $deleted = $this->glossaryRepository->delete($id);

            if( $deleted )
            {
                DB::commit();
                FileStorage::delete($imageData->path);
                return $this->deleted();
            }

            else
            {
                DB::rollback();
                return $this->notDeleted();
            }
        }

        catch(Exception $ex) 
        {
            Log::error($ex);
            DB::rollback();
            return $this->error();
        }
    }
}
