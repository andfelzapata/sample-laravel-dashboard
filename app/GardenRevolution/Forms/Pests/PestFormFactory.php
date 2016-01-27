<?php namespace App\GardenRevolution\Forms\Pests;

/*
 * Class to return forms regarding pest request validation.
 */

class PestFormFactory
{
    public function newGetPestFormInstance()
    {
        return new GetPestForm();
    }

    public function newUpdatePestFormInstance()
    {
        return new UpdatePestForm();
    }

    public function newStorePestFormInstance()
    {
        return new StorePestForm();
    }

    public function newDeletePestFormInstance()
    {
        return new DeletePestForm();
    }
}
