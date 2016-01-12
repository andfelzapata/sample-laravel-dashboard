<?php namespace App\GardenRevolution\Forms\Users;

/*
 * Class to return forms regarding user request validation.
 */

class UserFormFactory
{
    public function newGetUserFormInstance()
    {
        return new GetUserForm();
    }

    public function newUpdateUserformInstance()
    {
        return new UpdateUserForm();
    }

    public function newStoreUserFormInstance()
    {
        return new StoreUserForm();
    }

    public function newDeleteUserFormInstance()
    {
        return new DeleteUserForm();
    }
}
