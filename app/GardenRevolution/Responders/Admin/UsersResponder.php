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
        $data['users']->setPath('/admin/dashboard/#users');//Set pagination path on pagination object
        return response()->view('admin.dashboard.users.users',$data);
    }   
}
