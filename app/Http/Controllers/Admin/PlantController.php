<?php

namespace App\Http\Controllers\Admin;

use App\GardenRevolution\Responders\Admin\Users\StoreResponder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GardenRevolution\Services\PlantService;

use App\GardenRevolution\Responders\Admin\Plants\AllResponder;
use App\GardenRevolution\Responders\Admin\Plants\FindResponder;
use App\GardenRevolution\Responders\Admin\Plants\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Plants\CreateResponder;
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

            'categories',

            'subcategories',

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreResponder $responder)
    {
        $input = $request->all();

        return response($input, 500);

        $payload = $this->userService->store($input);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Form for plant edition";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
