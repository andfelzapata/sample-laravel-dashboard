<?php namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Forms\Settings\SettingsFormFactory;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\SettingsRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding settings
 */

class SettingsService extends Service
{
    private $settingsRepository;

    public function __construct(
                                PayloadFactory $payloadFactory, 
                                UserRepositoryInterface $userRepository,
                                SettingsRepositoryInterface $settingsRepository,
                                SettingsFormFactory $settingsFormFactory
                                )
    {
        $this->payloadFactory = $payloadFactory;
        $this->userRepository = $userRepository;
        $this->formFactory = $settingsFormFactory;
        $this->settingsRepository = $settingsRepository;
    }
    
    public function update($id, array $input)
    {
        $form = $this->formFactory->newUpdateSettingsFormInstance();

        $input['id'] = $id;

        $data = [];

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->settingsRepository->update($input,$id);

        if( $updated )
        {
            return $this->updated($data);
        }

        else
        {
            return $this->notUpdated($data);
        }
    }
    public function store(array $input)
    {
        $form = $this->formFactory->newStoreSettingsFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }
        
        $settings = $this->settingsRepository->create($input);

        if( $settings->id )
        {
            $userId = $input['user_id'];

            $user = $this->userRepository->find($userId);

            $user->settings()->save($settings);
            
            $data['settings_id'] = $settings->id;
            return $this->created($data);
        }

        else
        {
            return $this->notCreated();
        }
    }
}
