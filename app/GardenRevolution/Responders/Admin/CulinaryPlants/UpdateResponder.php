<?php namespace App\GardenRevolution\Responders\Admin\CulinaryPlants;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class UpdateResponder extends Responder
{
    /**
     * @var array
     */
    protected $payloadMethods = [
        PayloadStatus::UPDATED => 'updated',

        PayloadStatus::NOT_ACCEPTED => 'notAccepted'
    ];

    public function updated()
    {
        $data = $this->payload->getOutput();
        return response($data, 200);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response()->json($errors,422);
    }   
}
