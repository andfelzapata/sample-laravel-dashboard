<?php namespace App\GardenRevolution\Forms\Payments;

/*
 * Class to return forms regarding payment request validation.
 */

class PaymentFormFactory
{
    public function newUpdatePaymentFormInstance()
    {
        return new UpdatePaymentForm();
    }
    
    /**
    public function newStoreProfileFormInstance()
    {
        return new StoreProfileForm();
    }
    **/

    /**
    public function newDeleteUserFormInstance()
    {
        return new DeleteUserForm();
    }
    **/
}
