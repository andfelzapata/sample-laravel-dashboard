<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

abstract class Service 
{
    protected $payloadFactory;

    protected function success($output = []) 
    {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::SUCCESS);
        $payload->setOutput($output);
        return $payload;
    }
    
    protected function error() 
    {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::ERROR);
        $payload->setOutput($output);
        return $payload;
    }

    protected function accepted($output = []) 
    {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::ACCEPTED);
        $payload->setOutput($output);
        return $payload;
    }

    protected function notAccepted($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_ACCEPTED);
        $payload->setOutput($output);
        return $payload;
    }
    
    protected function created($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::CREATED);
        $payload->setOutput($output);
        return $payload;
    }
    
    protected function notCreated($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_CREATED);
        $payload->setOutput($output);
        return $payload;
    }

	protected function updated($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::UPDATED);
        $payload->setOutput($output);
        return $payload;
    }

    protected function notFound($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_FOUND);
        $payload->setOutput($output);
        return $payload;
    }
    
    protected function found($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::FOUND);
        $payload->setOutput($output);
        return $payload;
    }

    protected function deleted($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::DELETED);
        $payload->setOutput($output);
        return $payload;
    }

    protected function notDeleted($output) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_DELETED);
        $payload->setOutput($output);
        return $payload;
    }
}
