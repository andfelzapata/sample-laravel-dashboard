<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Services\JournalService;
use App\GardenRevolution\Responders\Admin\Journals\AllResponder;
use App\GardenRevolution\Responders\Admin\Journals\FindResponder;
use App\GardenRevolution\Responders\Admin\Journals\EditResponder;
use App\GardenRevolution\Responders\Admin\Journals\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Journals\CreateResponder;
use App\GardenRevolution\Responders\Admin\Journals\StoreResponder;
use App\GardenRevolution\Responders\Admin\Journals\DeleteResponder;

class JournalController extends Controller
{
    private $journalService;

    public function __construct(JournalService $journalService)
    {
        $this->journalService = $journalService;
    }

    /**
     * Display a listing of the resource.
     * @param AllResponder $responder
     *
     * @return mixed
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->journalService->getJournals(3, [

            'alert',

            'plant',

            'pest',

            'procedure',

            'user',

            'status'

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
        $payload = $this->journalService->create();

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

        $payload = $this->journalService->store($input);

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
        $payload = $this->journalService->getPlant($id);

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
        $payload = $this->journalService->edit($id);

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

        $payload = $this->journalService->update($id, $input);

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
        $payload = $this->journalService->delete($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
