<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Users\UserFormFactory;

use App\GardenRevolution\Responders\Responder;
use App\GardenRevolution\Responders\Admin\UsersResponder;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding users
 */

class UserService extends Service
{
    private $userRepository;
    protected $payloadFactory;
    private $userFormFactory;

    public function __construct(PayloadFactory $payloadFactory, UserRepositoryInterface $userRepository, UserFormFactory $formFactory) 
    {
        $this->userRepository = $userRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
    }

    public function getUsers() 
    {
        $users = $this->userRepository->getAllPaginated();
        
        if( $users ) 
        {
            $data = [
                        'users'=> $users
                    ];
            return $this->success($data);
        }
    }

    public function getUser($id)
    {
        $form = $this->formFactory->newGetUserFormInstance();

        $input = [];
        $input['id'] = $id;

        $data = [];

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $user = $this->userRepository->find($id);

        $data['user'] = $user;

        return $this->found($data);
    }

    public function update($id, array $input)
    {
        $form = $this->formFactory->newUpdateUserFormInstance();
        $input['id'] = $id;

        $data = [];

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->userRepository->update($input,$id);

        $data['username'] = $input['username'];
        
        if( $updated )
        {
            return $this->updated($data);
        }

        else
        {
            return $this->notUpdated($data);
        }
    }
}
