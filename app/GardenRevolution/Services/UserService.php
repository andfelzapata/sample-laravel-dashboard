<?php namespace App\GardenRevolution\Services;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;

/**
 * Class containing all useful methods for business logic around users
 */

class UserService 
{
    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($id) 
    {
        return $id;              
    }
}
