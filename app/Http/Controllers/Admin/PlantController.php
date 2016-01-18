<?php

namespace App\Http\Controllers\Admin;

use     Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Services\PlantService;
use App\GardenRevolution\Responders\Admin\Plants\AllResponder;
use App\GardenRevolution\Responders\Admin\Plants\FindResponder;
use App\GardenRevolution\Responders\Admin\Plants\EditResponder;
use App\GardenRevolution\Responders\Admin\Plants\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Plants\CreateResponder;
use App\GardenRevolution\Responders\Admin\Plants\StoreResponder;
use App\GardenRevolution\Responders\Admin\Plants\DeleteResponder;
use Illuminate\Support\Facades\Response;


class PlantController extends Controller
{
    /**
     * @var PlantService
     */
    private $plantService;

    public function __construct(PlantService $plantService)
    {
        $this->plantService = $plantService;
    }


    /**
     * @param AllResponder $responder
     * @return mixed
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->plantService->getPlants(15, [

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
        $payload = $this->plantService->create();

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * @param Request        $request
     * @param StoreResponder $responder
     *
     * @return mixed
     */
    public function store(Request $request, StoreResponder $responder)
    {
        $input = $request->all();

        $payload = $this->plantService->store($input);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * @param               $id
     * @param FindResponder $responder
     *
     * @return mixed
     */
    public function show($id, FindResponder $responder)
    {
        $payload = $this->plantService->getPlant($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param                   $id
     * @param EditResponder $responder
     *
     * @return mixed
     */
    public function edit($id, EditResponder $responder)
    {
        $payload = $this->plantService->edit($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Update the specified resource in storage.
     * @param Request         $request
     * @param                 $id
     * @param UpdateResponder $responder
     */
    public function update(Request $request, $id, UpdateResponder $responder)
    {
        $input = $request->all();

        $payload = $this->plantService->update($id, $input);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteResponder $responder)
    {
        $payload = $this->plantService->delete($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
