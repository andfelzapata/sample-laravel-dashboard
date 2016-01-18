<?php namespace App\GardenRevolution\Responders\Admin\Users;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class AllResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'users' ];

    public function users()
    {
        $data = $this->payload->getOutput();
        return response()->view('admin.dashboard.users.users',$data);
    }   
}
