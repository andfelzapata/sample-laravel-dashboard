<?php

namespace App\GardenRevolution\Forms\Terms;

/*
 * Class to return forms regarding term request validation.
 */

class TermFormFactory
{
    public function newGetTermFormInstance()
    {
        return new GetTermForm();
    }

    public function newUpdateTermFormInstance()
    {
        return new UpdateTermForm();
    }

    public function newStoreTermFormInstance()
    {
        return new StoreTermForm();
    }

    public function newDeleteTermFormInstance()
    {
        return new DeleteTermForm();
    }
}
