<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Services\CulinaryPlantService;
use App\GardenRevolution\Responders\Admin\Plants\AllResponder;
use App\GardenRevolution\Responders\Admin\Plants\FindResponder;
use App\GardenRevolution\Responders\Admin\Plants\EditResponder;
use App\GardenRevolution\Responders\Admin\Plants\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Plants\CreateResponder;
use App\GardenRevolution\Responders\Admin\Plants\StoreResponder;
use App\GardenRevolution\Responders\Admin\Plants\DeleteResponder;
use Illuminate\Support\Facades\Response;

class CulinaryPlantController extends Controller
{
    /**
     * @var CulinaryPlantService
     */
    private $culinaryPlantService;

    /**
     * CulinaryPlantController constructor.
     * @param CulinaryPlantService $culinaryPlantService
     */
    public function __construct(CulinaryPlantService $culinaryPlantService)
    {
        $this->culinaryPlantService = $culinaryPlantService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param AllResponder $responder
     * @return mixed
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->culinaryPlantService->getPlants(15, [

            'category',

            'subcategory',

            'maintenance'
        ]);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateResponder $responder
     * @return mixed
     */
    public function create(CreateResponder $responder)
    {
        $payload = $this->culinaryPlantService->create();

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param StoreResponder $responder
     * @return mixed
     */
    public function store(Request $request, StoreResponder $responder)
    {
        $input = $request->all();

        $payload = $this->culinaryPlantService->store($input);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @param FindResponder $responder
     * @return mixed
     */
    public function show($id, FindResponder $responder)
    {
        $payload = $this->culinaryPlantService->getPlant($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @param EditResponder $responder
     * @return mixed
     */
    public function edit($id,  EditResponder $responder)
    {
        $payload = $this->culinaryPlantService->edit($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @param UpdateResponder $responder
     * @return mixed
     */
    public function update(Request $request, $id, UpdateResponder $responder)
    {
        $input = $request->all();

        $payload = $this->culinaryPlantService->update($id, $input);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param DeleteResponder $responder
     * @return mixed
     */
    public function destroy($id, DeleteResponder $responder)
    {
        $payload = $this->culinaryPlantService->delete($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
