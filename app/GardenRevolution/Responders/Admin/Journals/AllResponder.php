<?php

namespace App\GardenRevolution\Responders\Admin\Journals;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'journals' ];

    public function journals()
    {
        $data = $this->payload->getOutput();
        $data['journals']->setPath('/admin/dashboard/#journals');//Set pagination path on pagination object
        return response()->view('admin.dashboard.journals.journals',$data);
    }   
}
