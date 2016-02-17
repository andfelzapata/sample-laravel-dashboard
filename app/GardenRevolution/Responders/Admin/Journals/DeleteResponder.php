<?php

namespace App\GardenRevolution\Responders\Admin\Glossary;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class DeleteResponder extends Responder
{
    protected $payloadMethods = [
        PayloadStatus::DELETED => 'deleted',

        PayloadStatus::NOT_DELETED => 'notDeleted',

        PayloadStatus::NOT_ACCEPTED => 'notAccepted'
    ];

    public function deleted()
    {
        return response()->json([],200);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response()->json($errors,406);
    }

    public function notDeleted()
    {
        return response()->json([],502);
    }   
}
