<?php

namespace App\GardenRevolution\Responders\Admin\Procedures;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [

        PayloadStatus::SUCCESS => 'procedures'

    ];

    /**
     * @return \Illuminate\Http\Response
     */
    public function procedures()
    {
        $data = $this->payload->getOutput();
        $data['procedures']->setPath('/admin/dashboard/#procedures');
        return response()->view('admin.dashboard.procedure-library.procedures', $data);
    }   
}
