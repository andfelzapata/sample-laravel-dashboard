<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GardenRevolution\Services\UserService;

use App\GardenRevolution\Responders\Admin\Users\AllResponder;
use App\GardenRevolution\Responders\Admin\Users\FindResponder;
use App\GardenRevolution\Responders\Admin\Users\DeleteResponder;
use App\GardenRevolution\Responders\Admin\Users\StoreResponder;
use App\GardenRevolution\Responders\Admin\Users\UpdateResponder;
use App\GardenRevolution\Responders\Admin\Users\CreateResponder;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param AllResponder $responder
     *
     * @return mixed
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->userService->getUsers();

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
        $payload = $this->userService->create();

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

        $payload = $this->userService->store($input);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FindResponder $responder)
    {
        $payload = $this->userService->getUser($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FindResponder $responder)
    {
        $payload = $this->userService->getUser($id);

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

        $payload = $this->userService->update($id,$input);

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
        $payload = $this->userService->delete($id);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
