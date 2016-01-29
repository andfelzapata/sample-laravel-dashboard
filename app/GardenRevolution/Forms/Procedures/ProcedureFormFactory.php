<?php namespace App\GardenRevolution\Forms\Procedures;

/*
 * Class to return forms regarding pest request validation.
 */

class ProcedureFormFactory
{
    public function newGetProcedureFormInstance()
    {
        return new GetProcedureForm();
    }

    public function newUpdateProcedureFormInstance()
    {
        return new UpdateProcedureForm();
    }

    public function newStoreProcedureFormInstance()
    {
        return new StoreProcedureForm();
    }

    public function newDeleteProcedureFormInstance()
    {
        return new DeleteProcedureForm();
    }
}
