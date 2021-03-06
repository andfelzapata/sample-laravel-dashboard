<?php namespace App\GardenRevolution\Services;

use DB;
use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Helpers\CategoryTypeTransformer;
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

    public function __construct(
        PayloadFactory $payloadFactory,
        CategoryRepositoryInterface $categoryRepository,
        CategoryTypeTransformer $categoryTypeTransformer,
        CategoryFormFactory $formFactory
    )
    {
        $this->payloadFactory = $payloadFactory;
        $this->categoryRepository = $categoryRepository;
        $this->categoryTypeTransformer = $categoryTypeTransformer;
        $this->formFactory = $formFactory;
    }
    
    /*
     * @param $page 
     * @return $mixed
     */
    public function index()
    {   
            $categoryTypes = array_flip($this->categoryTypeTransformer->getCategoryTypes());

            $pests = $this->categoryRepository->getPestCategoriesForPage();
            $plants = $this->categoryRepository->getPlantCategoriesForPage();            
            $procedures =  $this->categoryRepository->getProcedureCategoriesForPage();

            $pests->setPath('/admin/dashboard/#categories');//Set pagination path on pagination object
            $plants->setPath('/admin/dashboard/#categories');//Set pagination path on pagination object
            $procedures->setPath('/admin/dashboard/#categories');//Set pagination path on pagination object

            $output['pest_links'] = $pests->links();
            $output['plant_links'] = $plants->links();
            $output['procedure_links'] = $procedures->links();

            $pests = $pests->transform(
                                        function($item, $key) use ($categoryTypes) 
                                        {  
                                            $item->category_type = ucwords($categoryTypes[$item->category_type]);
                                            return $item;  
                                        }); 
            $plants = $plants->transform(
                                        function($item, $key) use ($categoryTypes) 
                                        {  
                                            $item->category_type = ucwords($categoryTypes[$item->category_type]);
                                            return $item;  
                                        }); 
            
            $procedures = $procedures->transform(
                                        function($item, $key) use ($categoryTypes) 
                                        {  
                                            $item->category_type = ucwords($categoryTypes[$item->category_type]);
                                            return $item;  
                                        }); 

            $output['procedures'] = $procedures;
            $output['pests'] = $pests;
            $output['plants'] = $plants;          

            return $this->success($output);
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

    /**
     * @param $id
     * @return mixed
     */
    public function find($id) 
    {
        $input['id'] = $id;

        $form = $this->formFactory->newGetCategoryFormInstance();
        
        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }
        
        $category = $this->categoryRepository->find($id);
        
        $output['category'] = $category;
 
        $categoryTypes = array_keys($this->categoryTypeTransformer->getCategoryTypes());
        $types = array();

        foreach($categoryTypes as $categoryType)
        {
            $types[$categoryType] = ucwords($categoryType);
        }

        $categoryTypes = array_flip($this->categoryTypeTransformer->getCategoryTypes());
        $category->category_type = $categoryTypes[$category->category_type];

        $output['types'] = $types;
        return $this->found($output);
    }
    
    /**
     * @param $id
     * @param array $input
     *
     * @return mixed
     */
    public function update($id, array $input)
    {
        $input['id'] = $id;
        
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

    public function delete($id)
    {
        $form = $this->formFactory->newDeleteCategoryFormInstance();
        $input['id'] = $id;

        $data = [];

        if( !$form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $deleted = $this->categoryRepository->delete($id);

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
