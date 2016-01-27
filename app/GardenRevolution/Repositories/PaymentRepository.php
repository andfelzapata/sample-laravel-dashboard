<?php 

namespace App\GardenRevolution\Repositories;

use App\Models\Payment;
use App\GardenRevolution\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    private $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function create(array $data)
    {
        $this->payment = $this->payment->newInstance()->create($data);
        return $this->payment;
    }

    public function update(array $data, $id)
    {
        $this->payment = $this->payment->newInstance()->find($id);

        if( is_null($this->payment) ) 
        {
            return false;
        }

        else 
        {
            $this->payment->fill($data);
            return $this->payment->save();
        }
    }

    public function delete($id)
    {
        $this->payment = $this->payment->newInstance()->find($id);

        if( is_null($this->payment) ) 
        {
            return false;
        }

        else 
        {
            return $this->payment->delete();
        }
    }

    public function find($id, $columns = array('*')) 
    {
        $this->payment = $this->payment->newInstance()->find($id,$columns);
        return $this->payment;
    }
}
