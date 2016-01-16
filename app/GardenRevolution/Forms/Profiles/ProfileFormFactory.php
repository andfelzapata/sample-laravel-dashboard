<?php namespace App\GardenRevolution\Forms\Profiles;

/*
 * Class to return forms regarding profile request validation.
 */

class ProfileFormFactory
{
    /**
    public function newGetUserFormInstance()
    {
        return new GetUserForm();
    }
    **/

    public function newUpdateProfileformInstance()
    {
        return new UpdateProfileForm();
    }

    public function newStoreProfileFormInstance()
    {
        return new StoreProfileForm();
    }

    /**
    public function newDeleteUserFormInstance()
    {
        return new DeleteUserForm();
    }
    **/
}
