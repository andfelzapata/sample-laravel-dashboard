<?php

namespace App\GardenRevolution\Responders\Admin\Subcategories;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

/*
 * Responder for create.
 */

class CreateResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::SUCCESS => 'create' ];

    public function create()
    {
        $data = $this->payload->getOutput();

        return response()->view('admin.dashboard.categories.create', $data);
    }   
}
