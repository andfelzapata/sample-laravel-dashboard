<?php

namespace App\GardenRevolution\Responders\Admin\CulinaryPlants;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [

        PayloadStatus::SUCCESS => 'culinary-plants'

    ];

    /**
     * @return \Illuminate\Http\Response
     */
    public function plants()
    {
        $data = $this->payload->getOutput();
        $data['culinary-plants']->setPath('/admin/dashboard/#culinary-plants');//Set pagination path on pagination object
        return response()->view('admin.dashboard.culinary-plant-library.culinary-plants', $data);
    }   
}
