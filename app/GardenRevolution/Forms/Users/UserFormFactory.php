<?php namespace App\GardenRevolution\Forms\Users;

class UserFormFactory
{
    public function newGetUserFormInstance()
    {
        return new GetUserForm();
    }
}
