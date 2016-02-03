<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Services\AlertService;
use App\GardenRevolution\Responders\Admin\Alerts\AllResponder;
use App\GardenRevolution\Responders\Admin\Alerts\FindResponder;
use App\GardenRevolution\Responders\Admin\Alerts\EditResponder;
use App\GardenRevolution\Responders\Admin\Alerts\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Alerts\CreateResponder;
use App\GardenRevolution\Responders\Admin\Alerts\StoreResponder;
use App\GardenRevolution\Responders\Admin\Alerts\DeleteResponder;

class AlertController extends Controller
{
    private $alertService;

    public function __construct(AlertService $alertService)
    {
        $this->alertService = $alertService;
    }

    /**
     * Display a listing of the resource.
     * @param AllResponder $responder
     *
     * @return mixed
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->alertService->getAlerts(15, [

            'procedure',

            'plant',

            'zone',

            'urgency'

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
        $payload = $this->alertService->create();

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

        $payload = $this->alertService->store($input);

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
        $payload = $this->alertService->getPlant($id);

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
        $payload = $this->alertService->edit($id);

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

        $payload = $this->alertService->update($id, $input);

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
        $payload = $this->alertService->delete($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
