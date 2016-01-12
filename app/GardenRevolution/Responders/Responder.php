<?php namespace App\GardenRevolution\Responders;
 
use Illuminate\Http\Response;
use Aura\Payload_Interface\PayloadInterface;

/*
 * Class for handling responses
 */
abstract class Responder {
    protected $payload;
    protected $payloadMethods; //An array of payload status associated with methods to call See respond() as an example of how this works
    protected $response;
    
    public function setPayload(PayloadInterface $payload) 
    {
        $this->payload = $payload;
    }
    
    /*
     * Calls the associated method to payload status
     */
    public function respond()
    {
        $status = $this->payload->getStatus();
        $method = isset($this->payloadMethods[$status]) ? $this->payloadMethods[$status] : 'notRecognized';
        return $this->$method();
    }

    /*
     * If a payload given without a status
     */
    protected function notRecognized()
    {
        return response()->view('errors.partials.invalid');
    }
}
