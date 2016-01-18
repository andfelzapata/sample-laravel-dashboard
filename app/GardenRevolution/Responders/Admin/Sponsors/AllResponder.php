<?php

namespace App\GardenRevolution\Responders\Admin\Sponsors;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'categories' ];

    public function users()
    {
        $data = $this->payload->getOutput();
        return response()->view('admin.dashboard.categories.categories',$data);
    }   
}
