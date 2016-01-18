<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GardenRevolution\Services\CategoryService;
use App\GardenRevolution\Responders\Admin\Categories\AllResponder;
use App\GardenRevolution\Responders\Admin\Categories\FindResponder;
use App\GardenRevolution\Responders\Admin\Categories\EditResponder;
use App\GardenRevolution\Responders\Admin\Categories\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Categories\CreateResponder;
use App\GardenRevolution\Responders\Admin\Categories\StoreResponder;
use App\GardenRevolution\Responders\Admin\Categories\DeleteResponder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
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
        $input = $request->only('category', 'category_type');

        $payload = $this->categoryService->store($input);

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
