<?php namespace App\GardenRevolution\Responders\Admin\Users;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

/*
 * @author Alan Ruvalcaba
 * @since 01-08-2016
 * Responder for create.
 */

class CreateResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'create' ];

    public function create()
    {
        return response()->view('admin/dashboard/users/create');
    }   
}
