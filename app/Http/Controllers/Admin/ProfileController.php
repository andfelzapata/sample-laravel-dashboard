<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GardenRevolution\Services\ProfileService;

use App\GardenRevolution\Responders\Admin\Profiles\StoreResponder;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
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

        $payload = $this->profileService->store($input);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
