<?php namespace App\GardenRevolution\Repositories;

use Stripe\Customer;
use App\GardenRevolution\Repositories\Contracts\CustomerRepositoryInterface;

/*
 * Repository for stripe customers
 */
class CustomerRepository implements CustomerRepositoryInterface {
    private $customer;

    public function __construct(Customer $customer) 
    {
        $this->customer = $customer;
    }
    
    public function find($id) 
    {
        if( is_null($id) )
        {
            return null;
        }

        else 
        {
            try
            {
                return $this->customer->retrieve($id);  
            }

            catch(Exception $ex)
            {
                return null;
            }
        }
    }
}
