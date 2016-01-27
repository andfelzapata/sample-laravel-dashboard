<?php
namespace App\GardenRevolution\Responders\Admin\Pests;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class CreateResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [

        PayloadStatus::SUCCESS => 'create'

    ];

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->payload->getOutput();
        return response()->view('admin.dashboard.pest-library.create', $data);
    }   
}
