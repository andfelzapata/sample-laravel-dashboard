<?php namespace App\GardenRevolution\Responders\Admin\Plants;

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
        return response()->json([], 200);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response()->json($errors,422);
    }   
}
