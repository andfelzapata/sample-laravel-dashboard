<?php namespace App\GardenRevolution\Forms\Plants;


class PlantFormFactory
{
    /**
     * @return GetPlantForm
     */
    public function newGetPlantFormInstance()
    {
        return new GetPlantForm;
    }

    /**
     * @return UpdatePlantForm
     */
    public function newUpdatePlantFormInstance()
    {
        return new UpdatePlantForm;
    }
}
