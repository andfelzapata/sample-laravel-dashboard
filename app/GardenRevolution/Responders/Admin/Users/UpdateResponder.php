<?php namespace App\GardenRevolution\Responders\Admin\Users;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class UpdateResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::UPDATED => 'updated' ];

    public function updated()
    {
        $output = $this->payload->getOutput();

        return $output['username'];
    }   
}
