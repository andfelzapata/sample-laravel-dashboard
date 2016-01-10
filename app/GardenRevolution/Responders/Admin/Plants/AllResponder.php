<?php

namespace App\GardenRevolution\Responders\Admin\Plants;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [

        PayloadStatus::SUCCESS => 'plants'

    ];

    /**
     * @return \Illuminate\Http\Response
     */
    public function plants()
    {
        $data = $this->payload->getOutput();
        $data['plants']->setPath('/admin/dashboard/#plants');//Set pagination path on pagination object
        return response()->view('admin.dashboard.plant-library.plants', $data);
    }   
}
