<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Services\PestService;
use App\GardenRevolution\Responders\Admin\Pests\AllResponder;
use App\GardenRevolution\Responders\Admin\Pests\FindResponder;
use App\GardenRevolution\Responders\Admin\Pests\EditResponder;
use App\GardenRevolution\Responders\Admin\Pests\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Pests\CreateResponder;
use App\GardenRevolution\Responders\Admin\Pests\StoreResponder;
use App\GardenRevolution\Responders\Admin\Pests\DeleteResponder;

class PestController extends Controller
{
    private $pestService;

    public function __construct(PestService $pestService)
    {
        $this->pestService = $pestService;
    }

    /**
     * Display a listing of the resource.
     * @param AllResponder $responder
     *
     * @return mixed
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->pestService->getPests(15, [
            'category',

            'subcategory',

            'severity',

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
        $payload = $this->pestService->create();

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

        $payload = $this->pestService->store($input);

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
        $payload = $this->pestService->getPlant($id);

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
        $payload = $this->pestService->edit($id);

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

        $payload = $this->pestService->update($id, $input);

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
        $payload = $this->pestService->delete($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
