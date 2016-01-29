<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Services\ProcedureService;
use App\GardenRevolution\Responders\Admin\Procedures\AllResponder;
use App\GardenRevolution\Responders\Admin\Procedures\FindResponder;
use App\GardenRevolution\Responders\Admin\Procedures\EditResponder;
use App\GardenRevolution\Responders\Admin\Procedures\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Procedures\CreateResponder;
use App\GardenRevolution\Responders\Admin\Procedures\StoreResponder;
use App\GardenRevolution\Responders\Admin\Procedures\DeleteResponder;

class ProcedureController extends Controller
{
    private $procedureService;

    public function __construct(ProcedureService $procedureService)
    {
        $this->procedureService = $procedureService;
    }

    /**
     * Display a listing of the resource.
     * @param AllResponder $responder
     *
     * @return mixed
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->procedureService->getProcedures(15, [
            'category',

            'subcategory',

            'urgency',

            'sponsor'
        ]);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateResponder $responder
     */
    public function create(CreateResponder $responder)
    {
        $payload = $this->procedureService->create();

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

        $payload = $this->procedureService->store($input);

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
        $payload = $this->procedureService->getPlant($id);

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
        $payload = $this->procedureService->edit($id);

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

        $payload = $this->procedureService->update($id, $input);

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
        $payload = $this->procedureService->delete($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
