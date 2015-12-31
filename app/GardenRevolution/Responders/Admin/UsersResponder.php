<?php namespace App\GardenRevolution\Responders\Admin;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

use App\GardenRevolution\Responders\Admin\Contracts\UsersResponderInterface;

class UsersResponder extends Responder implements UsersResponderInterface
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'users' ];

    public function users()
    {
        $data = $this->payload->getOutput();
        return response()->json($data);
    }   
}
