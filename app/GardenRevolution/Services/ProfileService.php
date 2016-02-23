<?php namespace App\GardenRevolution\Services;
use DB;

use Exception;

use App\Jobs\JobFactory;

use Aura\Payload\PayloadFactory;

use App\GardenRevolution\Helpers\FileStorage;

use App\GardenRevolution\Helpers\ReflectionHelper;

use App\GardenRevolution\Forms\Profiles\ProfileFormFactory;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;
use App\GardenRevolution\Repositories\Contracts\ProfileRepositoryInterface;

/**
* Class containing all useful methods for business logic regarding profiles
*/

class ProfileService extends Service
{
  private $profileRepository;

  public function __construct(
                                PayloadFactory $payloadFactory,
                                UserRepositoryInterface $userRepository,
                                ProfileRepositoryInterface $profileRepository,
                                ProfileFormFactory $profileFormFactory,
                                JobFactory $jobFactory
  )
  {
    $this->payloadFactory = $payloadFactory;
    $this->userRepository = $userRepository;
    $this->profileRepository = $profileRepository;
    $this->formFactory = $profileFormFactory;
    $this->jobFactory = $jobFactory;
  }

  public function update($id, array $input)
  {
    try {
      $form = $this->formFactory->newUpdateProfileFormInstance();

      $input['id'] = $id;

      $data = [];

      if( ! $form->isValid($input) )
      {
        $data['errors'] = $form->getErrors();
        return $this->notAccepted($data);
      }

      $profile = $this->profileRepository->find($id);

      $image = isset($input['image']) ? $input['image'] : null;

      //If an image has been uploaded, create paths to old file to be
      //deleted and new file to be stored
      if( isset($image) )
      {
        $imageData = json_decode($profile->image);

        if( isset($imageData) )
        {
          $subPath = $imageData->path;

          $pathToDelete = $subPath;
          $pathToMove = sprintf('images/profile/%s.%s',str_random(32),$image->getClientOriginalExtension());

          $image->path = $pathToMove;
          $input['image'] = json_encode($image);

          FileStorage::delete($pathToDelete);
          FileStorage::move($image->getRealPath(),$pathToMove);
        }

        else {
          //Pull image and alt tag
          $uploadedImage = array_pull($input,'image');
          $extension = $uploadedImage->getClientOriginalExtension();

          //Create subpath
          $folder = sprintf('%s/%s','images','profile');
          $filename = sprintf('%s.%s',str_random(32),$extension);

          //Create subpath to file
          $pathToMove = sprintf('%s/%s',$folder,$filename);
          $path = $pathToMove;

          $imageData = array('path'=>$path);
          $imageData = json_encode($imageData);

          $input['image'] = $imageData;

          FileStorage::move($image->getRealPath(),$pathToMove);
        }
      }

      $updated = $this->profileRepository->update($input,$id);
      $output['updated'] = $updated;

      if( $updated )
      {
        return $this->updated($output);
      }

      else
      {
        return $this->notUpdated($data);
      }
    }

    catch(Exception $ex) {
      return $this->error();
    }

  }
  public function store(array $input)
  {
    try {
      $form = $this->formFactory->newStoreProfileFormInstance();

      if( ! $form->isValid($input) )
      {
        $data['errors'] = $form->getErrors();
        return $this->notAccepted($data);
      }

      $image = isset($input['image']) ? $input['image'] : null;

      if( isset($input['image']) )
      {
        //Pull image and alt tag
        $uploadedImage = array_pull($input,'image');
        $extension = $uploadedImage->getClientOriginalExtension();

        //Create subpath
        $folder = sprintf('%s/%s','images','profile');
        $filename = sprintf('%s.%s',str_random(32),$extension);

        //Create subpath to file
        $pathToMove = sprintf('%s/%s',$folder,$filename);
        $path = $pathToMove;

        $imageData = array('path'=>$path);
        $imageData = json_encode($imageData);

        $input['image'] = $imageData;

        FileStorage::move($image->getRealPath(),$pathToMove);
      }

      $profile = $this->profileRepository->create($input);

      if( $profile->id )
      {
        $userId = $input['user_id'];

        $user = $this->userRepository->find($userId);

        $user->profile()->save($profile);

        $fullname = $profile->fullname;
        $jobData = array('fullname'=>$fullname);
        $job = $this->jobFactory->newWelcomeNotificationInstance($jobData);

        dispatch($job);


        $data['profile_id'] = $profile->id;
        return $this->created($data);
      }

      else
      {
        return $this->notCreated();
      }
    }

    catch(Exception $ex) {
      return $this->error();
    }
  }
}
