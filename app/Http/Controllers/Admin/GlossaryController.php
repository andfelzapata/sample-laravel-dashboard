<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GardenRevolution\Services\GlossaryService;
use App\GardenRevolution\Responders\Admin\Glossary\AllResponder;
use App\GardenRevolution\Responders\Admin\Glossary\FindResponder;
use App\GardenRevolution\Responders\Admin\Glossary\EditResponder;
use App\GardenRevolution\Responders\Admin\Glossary\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Glossary\CreateResponder;
use App\GardenRevolution\Responders\Admin\Glossary\StoreResponder;
use App\GardenRevolution\Responders\Admin\Glossary\DeleteResponder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GlossaryController extends Controller
{
    private $glossaryService;

    public function __construct(GlossaryService $glossaryService)
    {
        $this->glossaryService = $glossaryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->glossaryService->index();

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateResponder $responder)
    {
        $payload = $this->glossaryService->create();

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param StoreResponder $responder
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreResponder $responder)
    {
        $input = $request->all();

        $payload = $this->glossaryService->store($input);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, EditResponder $responder)
    {
        $payload = $this->glossaryService->find($id);
        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateResponder $responder)
    {
        $input = $request->all();

        $payload = $this->glossaryService->update($id,$input);
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
        $payload = $this->glossaryService->delete($id);
        $responder->setPayload($payload);

        return $responder->respond();
    }
}
