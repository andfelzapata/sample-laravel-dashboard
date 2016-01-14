<?php namespace App\GardenRevolution\Forms\Plants;

/*
 * Class to return forms regarding plant request validation.
 */

class PlantFormFactory
{
    public function newGetPlantFormInstance()
    {
        return new GetPlantForm();
    }

    public function newUpdatePlantformInstance()
    {
        return new UpdatePlantForm();
    }

    public function newStorePlantFormInstance()
    {
        return new StorePlantForm();
    }

    public function newDeletePlantFormInstance()
    {
        return new DeletePlantForm();
    }
}
