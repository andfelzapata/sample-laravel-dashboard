<?php

namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;
use App\GardenRevolution\Forms\Plants\PlantFormFactory;
use App\GardenRevolution\Responders\Responder;
use App\GardenRevolution\Responders\Admin\PlantsResponder;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding plants
 */
class PlantService extends Service
{
    /**
     * @var PlantRepository
     */
    private $plantRepository;

    /**
     * @var PayloadFactory
     */
    protected $payloadFactory;

    /**
     * @var
     */
    private $plantFormFactory;

    public function __construct(PayloadFactory $payloadFactory, PlantRepositoryInterface $plantRepository, PlantFormFactory $formFactory)
    {
        $this->plantRepository = $plantRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
    }

    /**
     * @param $pages
     * @param $eagerLoads
     * @return mixed
     */
    public function getPlants($pages, $eagerLoads)
    {
        $plants = $this->plantRepository->getAllPaginated($pages, $eagerLoads);

        if( $plants )
        {
            $data = [
                'plants'=> $plants
            ];

            return $this->success($data);
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getPlant($id)
    {
        $form = $this->formFactory->newGetPlantFormInstance();

        $input = [];
        $input['id'] = $id;
        $data = [];

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $plant = $this->plantRepository->find($id);

        $data['plant'] = $plant;

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
        $form = $this->formFactory->newUpdatePlantFormInstance();
        $input['id'] = $id;

        $data = [];

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->plantRepository->update($input,$id);

        $data['plantname'] = $input['plantname'];

        if( $updated )
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
}
