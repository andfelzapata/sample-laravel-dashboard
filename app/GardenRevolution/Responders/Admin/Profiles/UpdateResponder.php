<?php namespace App\GardenRevolution\Responders\Admin\Profiles;

use Aura\Payload_Interface\PayloadStatus;

use App\GardenRevolution\Responders\Responder;

class UpdateResponder extends Responder
{
    protected $payloadMethods = [ PayloadStatus::UPDATED => 'updated', PayloadStatus::NOT_ACCEPTED => 'notAccepted', PayloadStatus::NOT_UPDATED => 'notUpdated' ];

    public function updated()
    {
        $data = $this->payload->getOutput();
        return response()->json($data,200);
    }

    public function notAccepted()
    {
        $errors = $this->payload->getOutput()['errors'];

        return response()->json($errors,422);
    }

    public function notUpdated()
    {
      $data = $this->payload->getOutput();
      return response()->json($data,400);
    }
}
