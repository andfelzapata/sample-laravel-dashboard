<?php namespace App\GardenRevolution\Responders\Admin\Users;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class StoreResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::CREATED => 'created', PayloadStatus::NOT_ACCEPTED => 'notAccepted', PayloadStatus::NOT_CREATED => 'notCreated' ];

    public function created()
    {
        return response()->json([],201);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response()->json($errors,406);
    }

    public function notCreated()
    {
        return response()->json([],502);
    }   
}
