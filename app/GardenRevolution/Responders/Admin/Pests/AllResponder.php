<?php

namespace App\GardenRevolution\Responders\Admin\Pests;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [

        PayloadStatus::SUCCESS => 'pests'

    ];

    /**
     * @return \Illuminate\Http\Response
     */
    public function pests()
    {
        $data = $this->payload->getOutput();
        $data['pests']->setPath('/admin/dashboard/#pests');
        return response()->view('admin.dashboard.pest-library.pests', $data);
    }   
}
