<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GardenRevolution\Services\NotificationService;

use App\GardenRevolution\Responders\Admin\Notifications\AllResponder;

class NotificationController extends Controller
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AllResponder $responder)
    {
        $payload = $this->notificationService->index();

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
