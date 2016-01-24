<?php namespace App\GardenRevolution\Forms\Payments;

/*
 * Form to validate updating a payment option.
 */

use App\GardenRevolution\Forms\Form;

class UpdatePaymentForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|exists:payments,id',
                'user_id'=>'required|exists:users,id',
                'token'=>'required',
                'exp_month'=>'required',
                'exp_year'=>'required',
                'last4'=>'required|max:4|min:4'
               ];        
    }
}
