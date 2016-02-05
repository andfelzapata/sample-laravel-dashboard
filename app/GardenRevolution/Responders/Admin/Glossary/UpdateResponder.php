<?php

namespace App\GardenRevolution\Responders\Admin\Glossary;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class UpdateResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::UPDATED => 'updated', PayloadStatus::NOT_ACCEPTED => 'notAccepted', PayloadStatus::NOT_UPDATED => 'notUpdated' ];

    public function updated()
    {
        return response()->json([],200);
    }

    public function notUpdated()
    {
        return response()->json([],502);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response()->json($errors,422);
    }   
}
