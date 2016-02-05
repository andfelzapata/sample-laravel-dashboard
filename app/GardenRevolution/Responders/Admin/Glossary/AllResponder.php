<?php

namespace App\GardenRevolution\Responders\Admin\Glossary;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'terms' ];

    public function terms()
    {
        $data = $this->payload->getOutput();
        return response()->view('admin.dashboard.glossary.glossary',$data);
    }   
}
