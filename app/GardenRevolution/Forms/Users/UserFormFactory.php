<?php namespace App\GardenRevolution\Forms\Users;

/*
 * @author Alan Ruvalcaba
 * @since 01-06-2016
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
}
