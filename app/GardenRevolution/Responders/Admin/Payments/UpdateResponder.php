<?php namespace App\GardenRevolution\Responders\Admin\Payments;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class UpdateResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::UPDATED => 'updated', PayloadStatus::NOT_ACCEPTED => 'notAccepted', PayloadStatus::ERROR => 'error', PayloadStatus::NOT_UPDATED => 'notUpdated' ];

    public function updated()
    {
        return response()->json([],200);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];
        return response()->json($errors,406);
    }

    public function notUpdated()
    {
        $error = $this->payload->getOutput();
        return response()->json($error,502);
    }

    public function error()
    {
        $error = $this->payload->getOutput();
        return response()->json($error,502);
    }   
}
