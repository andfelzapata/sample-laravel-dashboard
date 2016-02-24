<?php namespace App\GardenRevolution\Services;

use Stripe\Customer;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Payments\PaymentFormFactory;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\CustomerRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\PaymentRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding payment options
 */

class PaymentService extends Service
{
    private $paymentRepository;

    public function __construct(
                                PayloadFactory $payloadFactory, 
                                UserRepositoryInterface $userRepository,
                                CustomerRepositoryInterface $customerRepository,
                                PaymentRepositoryInterface $paymentRepository,
                                PaymentFormFactory $paymentFormFactory
                                )
    {
        $this->payloadFactory = $payloadFactory;
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
        $this->formFactory = $paymentFormFactory;
        $this->paymentRepository = $paymentRepository;
    }
    
    public function update($id, array $input)
    {
        try {
            $form = $this->formFactory->newUpdatePaymentFormInstance();

            $data = [];

            $input['id'] = $id;

            if( ! $form->isValid($input) )
            {
                $data['errors'] = $form->getErrors();
                return $this->notAccepted($data);
            }

            $user = $this->userRepository->find($input['user_id']);
            $payment = $this->paymentRepository->find($id);

            $customerId = $user->stripe_id;
            $customer = $this->customerRepository->find($customerId);

            $oldCard = $customer->sources->retrieve($payment->card_id);
            $newCard = $customer->sources->create(array('source'=>$input['token']));

            $cardInfo = array('card_id'=>$newCard->id,'exp_month'=>$newCard->exp_month,'exp_year'=>$newCard->exp_year,'last4'=>$newCard->last4);

            $updated = $this->paymentRepository->update($cardInfo,$id);

            $oldCard->delete();

            if( $updated )
            {
                return $this->updated($data);
            }

            else
            {
                $data['error'] = $this->msg('errors.update',['resource'=>'payment option']);
                return $this->notUpdated($data);
            }
        }

        catch(Exception $ex)
        {
            $data['error'] = $this->msg('errors.update',['resource'=>'payment option']);
            return $this->error();
        }
    }
}
