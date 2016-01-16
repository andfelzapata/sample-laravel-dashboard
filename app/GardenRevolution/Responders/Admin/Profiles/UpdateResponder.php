<?php namespace App\GardenRevolution\Responders\Admin\Profiles;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class UpdateResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::UPDATED => 'updated', PayloadStatus::NOT_ACCEPTED => 'notAccepted' ];

    public function updated()
    {
        return response()->json([],200);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response()->json($errors,406);
    }   
}
