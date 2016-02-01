<?php

namespace App\GardenRevolution\Responders\Admin\Alerts;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [

        PayloadStatus::SUCCESS => 'alerts'

    ];

    /**
     * @return \Illuminate\Http\Response
     */
    public function alerts()
    {
        $data = $this->payload->getOutput();
        $data['alerts']->setPath('/admin/dashboard/#alerts');
        return response()->view('admin.dashboard.alerts.alerts', $data);
    }   
}
