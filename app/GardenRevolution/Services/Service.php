<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

abstract class Service 
{
    /**
     * @var
     */
    protected $payloadFactory;

    /**
     * @param array $output
     *
     * @return mixed
     */
    protected function success($output = []) 
    {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::SUCCESS);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * TODO
     */
    protected function error() 
    {
    }

    /**
     * @param array $output
     *
     * @return mixed
     */
    protected function accepted($output = []) 
    {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::ACCEPTED);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * @param array $output
     *
     * @return mixed
     */
    protected function notAccepted($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_ACCEPTED);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * @param array $output
     *
     * @return mixed
     */
    protected function created($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::CREATED);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * @param array $output
     *
     * @return mixed
     */
	protected function updated($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::UPDATED);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * @param array $output
     *
     * @return mixed
     */
    protected function notFound($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_FOUND);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * @param array $output
     *
     * @return mixed
     */
    protected function found($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::FOUND);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * @param array $output
     *
     * @return mixed
     */
    protected function deleted($output = []) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::DELETED);
        $payload->setOutput($output);
        return $payload;
    }

    /**
     * @param $output
     *
     * @return mixed
     */
    protected function notDeleted($output) {
        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_DELETED);
        $payload->setOutput($output);
        return $payload;
    }
}
