<?php namespace App\GardenRevolution\Forms\Settings;

/*
 * Class to return forms regarding profile request validation.
 */

class SettingsFormFactory
{
    /**
    public function newGetUserFormInstance()
    {
        return new GetUserForm();
    }
    **/

    public function newUpdateSettingsformInstance()
    {
        return new UpdateSettingsForm();
    }

    public function newStoreSettingsFormInstance()
    {
        return new StoreSettingsForm();
    }

    /**
    public function newDeleteUserFormInstance()
    {
        return new DeleteUserForm();
    }
    **/
}
