<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GardenRevolution\Services\SponsorService;
use App\GardenRevolution\Responders\Admin\Sponsors\AllResponder;
use App\GardenRevolution\Responders\Admin\Sponsors\FindResponder;
use App\GardenRevolution\Responders\Admin\Sponsors\EditResponder;
use App\GardenRevolution\Responders\Admin\Sponsors\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Sponsors\CreateResponder;
use App\GardenRevolution\Responders\Admin\Sponsors\StoreResponder;
use App\GardenRevolution\Responders\Admin\Sponsors\DeleteResponder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SponsorController extends Controller
{
    /**
     * @var SponsorService
     */
    private $sponsorService;

    public function __construct(SponsorService $sponsorService)
    {
        $this->sponsorService = $sponsorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreResponder $responder
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreResponder $responder)
    {
        $input = $request->except('_token');

        $payload = $this->sponsorService->store($input);

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
    public function edit($id)
    {
        //
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
