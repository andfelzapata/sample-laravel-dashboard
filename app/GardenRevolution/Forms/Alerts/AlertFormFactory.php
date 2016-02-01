<?php namespace App\GardenRevolution\Forms\Alerts;

/*
 * Class to return forms regarding alerts request validation.
 */

class AlertFormFactory
{
    public function newGetAlertFormInstance()
    {
        return new GetAlertForm();
    }

    public function newUpdateAlertFormInstance()
    {
        return new UpdateAlertForm();
    }

    public function newStoreAlertFormInstance()
    {
        return new StoreAlertForm();
    }

    public function newDeleteAlertFormInstance()
    {
        return new DeleteAlertForm();
    }
}
