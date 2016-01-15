<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Profiles\ProfileFormFactory;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\ProfileRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding users
 */

class ProfileService extends Service
{
    private $profileRepository;

    public function __construct(
                                PayloadFactory $payloadFactory, 
                                UserRepositoryInterface $userRepository,
                                ProfileRepositoryInterface $profileRepository,
                                ProfileFormFactory $profileFormFactory
                                )
    {
        $this->payloadFactory = $payloadFactory;
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->formFactory = $profileFormFactory;
    }

    public function store(array $input)
    {
        $form = $this->formFactory->newStoreProfileFormInstance();
        
        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }
        
        $profile = $this->profileRepository->create($input);

        if( $profile->id )
        {
            $userId = $input['user_id'];

            $user = $this->userRepository->find($userId);

            $user->profile()->save($profile);
            
            $data['profile_id'] = $profile->id;
            return $this->created($data);
        }

        else
        {
            return $this->notCreated();
        }
     }
}
