<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Responders\Responder;
use App\GardenRevolution\Responders\Admin\UsersResponder;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;

/**
 * Class containing all useful methods for business logic around users
 */

class UserService extends Service
{
    public function __construct(PayloadFactory $payloadFactory, UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
        $this->payloadFactory = $payloadFactory;
    }

    public function getUsers() 
    {
        $users = $this->userRepository->getAll();

        if( $users ) 
        {
            $data = [
                        'users'=> $users
                    ];
            return $this->success($data);
        }
    }
}
