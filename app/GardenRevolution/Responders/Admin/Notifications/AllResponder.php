<?php

namespace App\GardenRevolution\Responders\Admin\Notifications;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'notifications' ];

    public function notifications()
    {
        $data = $this->payload->getOutput();
        return response()->view('admin.dashboard.system-notifications.system-notifications',$data);
    }   
}
