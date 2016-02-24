<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\GardenRevolution\Services\SubcategoryService;
use App\GardenRevolution\Responders\Admin\Subcategories\AllResponder;
use App\GardenRevolution\Responders\Admin\Subcategories\FindResponder;
use App\GardenRevolution\Responders\Admin\Subcategories\EditResponder;
use App\GardenRevolution\Responders\Admin\Subcategories\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Subcategories\CreateResponder;
use App\GardenRevolution\Responders\Admin\Subcategories\StoreResponder;
use App\GardenRevolution\Responders\Admin\Subcategories\DeleteResponder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    /**
     * @var SubcategoryService
     */
    private $subcategoryService;

    public function __construct(SubcategoryService $subcategoryService)
    {
        $this->subcategoryService = $subcategoryService;
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
     * @param  \Illuminate\Http\Request  $request
     * @param StoreResponder $responder
      * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreResponder $responder)
    {
        $input = $request->only('subcategory', 'subcategory_type');

        $payload = $this->subcategoryService->store($input);

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
