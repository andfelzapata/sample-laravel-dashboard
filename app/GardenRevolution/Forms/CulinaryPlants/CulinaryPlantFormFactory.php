<?php namespace App\GardenRevolution\Forms\CulinaryPlants;

/*
 * Class to return forms regarding culinary plant request validation.
 */

class CulinaryPlantFormFactory
{
    public function newGetCulinaryPlantFormInstance()
    {
        return new GetCulinaryPlantForm();
    }

    public function newUpdateCulinaryPlantFormInstance()
    {
        return new UpdateCulinaryPlantForm();
    }

    public function newStoreCulinaryPlantFormInstance()
    {
        return new StoreCulinaryPlantForm();
    }

    public function newDeleteCulinaryPlantFormInstance()
    {
        return new DeleteCulinaryPlantForm();
    }
}
