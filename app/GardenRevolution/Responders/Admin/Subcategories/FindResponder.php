<?php

namespace App\GardenRevolution\Responders\Admin\Subcategories;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class FindResponder extends Responder
{
    protected $payloadMethods = [
        PayloadStatus::NOT_ACCEPTED => 'notAccepted',

        PayloadStatus::FOUND => 'found'
    ];

    public function notAccepted()
    {
        $data = $this->payload->getOutput();
        //TODO return a response
    }

    public function found()
    {
        $data = $this->payload->getOutput();
        return response()->view('admin.dashboard.categories.edit',$data);
    }   
}
