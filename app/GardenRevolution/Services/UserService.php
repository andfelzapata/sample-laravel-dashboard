<?php namespace App\GardenRevolution\Services;

use DB;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Factories\RoleFactory;

use App\GardenRevolution\Forms\Users\UserFormFactory;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;

use App\GardenRevolution\Repositories\Contracts\StateRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding users
 */

class UserService extends Service
{
    private $userRepository;
    protected $payloadFactory;
    private $userFormFactory;
    private $roleFactory;
    private $profileRepository;
    private $stateRepository;

    public function __construct(
                                PayloadFactory $payloadFactory, 
                                UserRepositoryInterface $userRepository,
                                StateRepositoryInterface $stateRepository,
                                UserFormFactory $formFactory, 
                                RoleFactory $roleFactory) 
    {
        $this->userRepository = $userRepository;
        $this->stateRepository = $stateRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
        $this->roleFactory = $roleFactory;
    }

    public function getUsers() 
    {
        $users = $this->userRepository->getAllPaginated();
        
        if( $users ) 
        {

            $users->setPath('/admin/dashboard/#users');//Set pagination path on pagination object
            
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

        $states = $this->stateRepository->getAll();

        $user = $this->userRepository->find($id);

        $data['user'] = $user;
        $data['states'] = $states;
        $data['profile'] = $user->profile;
        $data['settings'] = $user->settings;

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

        if( isset($input['password']) ) {
            $input['password'] = bcrypt($input['password']);
        }

        $updated = $this->userRepository->update($input,$id);

        if( $updated )
        {
            return $this->updated($data);
        }

        else
        {
            return $this->notUpdated($data);
        }
    }

    public function create()
    {
        $data['states'] = $this->stateRepository->getAll();
        return $this->success($data);
    }

    public function store(array $input)
    {
        $form = $this->formFactory->newStoreUserFormInstance();
        
        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }
        
        $userRole = $this->roleFactory->getUserRole();
            
        if( $userRole )
        {
            $input['password'] = bcrypt($input['password']);
            $user = $this->userRepository->createWithRole($input,$userRole);

            if( $user )
            {
                $data['user_id'] = $user->id;
                return $this->created($data);
            }

            else
            {
                return $this->notCreated();
            }
        }

        else
        {
            return $this->notCreated();
        }
    }

    public function delete($id)
    {
        $form = $this->formFactory->newDeleteUserFormInstance();
        $input['id'] = $id;

        $data = [];

        if( !$form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $deleted = $this->userRepository->delete($id);

        if( $deleted )
        {
            return $this->deleted();
        }

        else
        {
            return $this->notDeleted();
        }
    }
}
