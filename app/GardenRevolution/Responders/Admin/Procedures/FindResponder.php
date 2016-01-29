<?php namespace App\GardenRevolution\Responders\Admin\Procedures;

use Aura\Payload_Interface\PayloadStatus;
use App\GardenRevolution\Responders\Responder;

class FindResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [
        PayloadStatus::NOT_ACCEPTED => 'notAccepted',

        PayloadStatus::FOUND => 'found'
    ];

    public function notAccepted()
    {
        $data = $this->payload->getOutput();
        //TODO return a response
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function found()
    {
        $data = $this->payload->getOutput();
        return response()->view('admin.dashboard.procedure-library.procedure',$data);
    }   
}
