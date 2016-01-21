<?php

namespace App\GardenRevolution\Responders\Admin\Subcategories;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class StoreResponder extends Responder
{
    protected $payloadMethods = [
        PayloadStatus::CREATED => 'created',

        PayloadStatus::NOT_ACCEPTED => 'notAccepted',

        PayloadStatus::NOT_CREATED => 'notCreated'
    ];

    public function created()
    {
        $data = $this->payload->getOutput();
        return response($data, 201);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response($errors, 422);
    }

    public function notCreated()
    {
        $errors = $this->payload->getOutput()['errors'];
        return response($data, 502);
    }   
}
